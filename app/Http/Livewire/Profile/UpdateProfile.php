<?php

namespace App\Http\Livewire\Profile;

use App\Helpers\CarrierEmailHelper;
use Exception;

use App\Jobs\SendText;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

use Twilio\Rest\Client;

class UpdateProfile extends Component {
  public $state = [];

  public $verificationCodeInput = '';
  public $formattedPhoneNumber;

  public array $errorMessages;

  protected $listeners = ['refreshProfileCard' => '$refresh'];

  function rules() {
    return [
      'state.firstname' => 'required|string|max:50',
      'state.lastname' => 'required|string|max:50',
      'state.school' => 'nullable|string|max:100',
      'state.email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
      'state.phone' => 'nullable|digits:10'
    ];
  }

  protected $messages = [
    'state.firstname.required' => 'Your first name is required',
    'state.firstname.max' => 'The name you entered is too long',
    'state.lastname.required' => 'Your last name is required',
    'state.lastname.max' => 'The name you entered is too long',
    'state.email.required' => 'An email address is required',
    'state.email.email' => 'Double check that the email address is valid',
    'state.email.unique' => 'Gadzooks, looks like that email is already in use. Your doppelgänger maybe?',
    'state.school.max' => 'Must be 100 characters or less',
    'state.phone.digits' => 'Must be 10 digits long and not include dashes'
  ];

  public function mount() {
    $this->state = Auth::user()->withoutRelations()->toArray();
  }

  /**
   * Validate updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  /**
   * Validate verification code on update
   * @return void
   */
  public function updatedVerificationCodeInput() {
    if (strlen($this->verificationCodeInput) < 6)
      $this->addError('verificationCodeInput', 'The verification code should be six numbers long');
  }


  /**
   * Display phone number confirmation and text user
   * @return void
   */
  public function showPhoneConfirmation() {
    $code = rand(100000, 999999);
    $this->sendTextMessage($code);

    $phoneNumber = $this->state['phone'];
    $this->formattedPhoneNumber = '(' . substr($phoneNumber, 0, 3) . ') ' . substr($phoneNumber, 3, 3) . '-' . substr($phoneNumber, 6, 10);
    $this->dispatchBrowserEvent('display-phone-verification');

    DB::table('two_factor_codes')->insert([
      'user_id' => Auth::user()->id,
      'two_factor_code' => $code,
    ]);
  }

  /**
   * Check verification code and save number
   * @return void
   */
  public function confirmVerification() {
    $user = Auth::user();
    $verify = DB::table('two_factor_codes')->where('user_id', Auth::user()->id)->first();

    if ($this->verificationCodeInput == $verify->two_factor_code) {
      $this->dispatchBrowserEvent('hide-phone-verification');
      $this->emit('toastMessage', 'Phone number successfully verified');

      $user->phone = $this->state['phone'];
      $user->carrier = $this->state['carrier'];
      $user->save();
    } else
      $this->addError('verificationCodeInput', 'The verification code you inputted is incorrect');
    $this->reset('verificationCodeInput');
  }

  /**
   * Send verification code textf
   * @param  int $code
   * @return void
   */
  public function sendTextMessage($code) {
    if (CarrierEmailHelper::getCarrierEmail($this->state['carrier']) == null)
      $this->addError('verificationCodeInput', 'The phone number you entered is not compatible.');
    else {
      $message = 'Hey there! Your verification code for Schedulist is ' . $code . '. If you didn\'t request one feel free to ignore this text.';
      $email = $this->state['phone'] . CarrierEmailHelper::getCarrierEmail($this->state['carrier']);
      $details = ['email' => $email, 'message' => $message];
      SendText::dispatchSync($details);
      $this->dispatchBrowserEvent('start-countdown');
    }
  }

  /**
   * Cancels phone number validation and resets
   * @return void
   */
  public function cancelValidation() {
    $this->state['phone'] = Auth::user()->phone;
  }

  /**
   * Sends new verification code to user
   * @return void
   */
  public function resendAndCount() {
    $code = rand(100000, 999999);
    $this->sendTextMessage($code);
    DB::table('two_factor_codes')->insert([
      'user_id' => Auth::user()->id,
      'two_factor_code' => $code,
    ]);
    $this->emit('toastMessage', 'A new verification code was sent');
  }

  /**
   * Validates phone number using Twilio
   * @param  string $number
   * @return bool
   */
  public function validatePhoneNumber($number) {
    $sid = config('twilio.account_sid');
    $token = config('twilio.auth_token');
    $twilio = new Client($sid, $token);

    try {
      $phone_number = $twilio->lookups->v1->phoneNumbers($number)->fetch(["countryCode" => "US", "type" => ["carrier"]]);
    } catch (Exception $e) {
      if ($e->getStatusCode() == 404) {
        $this->addError('state.phone', 'The phone number provided is invalid');
        return false;
      } else {
        throw $e;
      }
    }
    $this->state['carrier'] = $phone_number->carrier['name'];
    return true;
  }

  /**
   * Save the user's updated profile information
   * @return void
   */
  public function save() {
    $user = Auth::user();
    if ($user->withoutRelations()->toArray() == $this->state)
      $this->emit('toastMessage', 'No changes were made');
    else {
      $this->validate();
      $user->forceFill([
        'firstname' => $this->state['firstname'],
        'lastname' => $this->state['lastname'],
        'email' => $this->state['email'],
        'school' => $this->state['school'],
        'grade_level' => $this->state['grade_level'],
      ])->save();
      if ($this->state['phone'] == null) {
        $user->phone = null;
        $user->save();
      }
      $this->emit('toastMessage', 'Profile changes saved');
      $this->emit('refresh-navigation-menu');
      if (Auth::user()->phone != $this->state['phone']) {
        DB::table('two_factor_codes')->where('user_id', Auth::user()->id)->delete();
        $validated = $this->validatePhoneNumber($this->state['phone']);
        if ($validated && CarrierEmailHelper::getCarrierEmail($this->state['carrier']) != null)
          $this->showPhoneConfirmation();
        else
          $this->addError('state.phone', 'The phone number you entered is not compatible.');
      }
    }
  }

  /**
   * Sets user grade value from select menu
   * @param string $grade
   */
  public function setGrade($grade) {
    $this->state['grade_level'] = $grade;
  }

  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.profile.update-profile');
  }
}
