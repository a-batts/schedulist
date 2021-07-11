<?php

namespace App\Http\Livewire\Profile;

use Exception;

use App\Jobs\SendText;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

use Twilio\Rest\Client;

class UpdateProfile extends Component
{
    public $state = [];
    public $phoneError = false;
    public $showingPhoneConfirmation = false;
    public $verificationCodeInput;
    public $formattedPhoneNumber;

    public $hasProfilePicture = false;
    public $profileURL;

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

    protected $carriers = [
      'Verizon Wireless' => '@vtext.com',
      'T-Mobile' => '@tmomail.net',
      'AT&T Wireless' => '@txt.att.net',
      'Sprint' => '@messaging.sprintpcs.com',
    ];

    /**
     * Mount Component
     * @return void
     */
    public function mount() {
      $this->state = Auth::user()->withoutRelations()->toArray();
      $this->verificationCodeInput = '';
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
    public function updatedVerificationCodeInput(){
      if(strlen($this->verificationCodeInput) < 6)
        $this->addError('verificationCodeInput', 'The verification code should be six numbers long');
    }

    /**
     * Save the user's updated profile information
     * @return void
     */
    public function save() {
        $user = Auth::user();
        if ($user->firstname == $this->state['firstname'] && $user->lastname == $this->state['lastname']
        && $user->email == $this->state['email'] && $user->school == $this->state['school'] && $user->grade_level == $this->state['grade_level'] && $user->phone == $this->state['phone']) {
            $this->emit('toastMessage', 'No changes were made');
        }
        else {
          $this->validate();
          $user->forceFill([
              'firstname' => $this->state['firstname'],
              'lastname' => $this->state['lastname'],
              'email' => $this->state['email'],
              'school' => $this->state['school'],
              'grade_level' => $this->state['grade_level'],
          ])->save();
          if ($this->state['phone'] == null){
            $user->phone = null;
            $user->save();
          }
          $this->emit('toastMessage', 'Profile changes saved');
          $this->emit('refresh-navigation-menu');
          if (Auth::user()->phone != $this->state['phone']){
            DB::table('two_factor_codes')->where('user_id', Auth::User()->id)->delete();

            $this->validatePhoneNumber($this->state['phone']);
            if (! $this->phoneError && isset($this->state['carrier']) && $this->state['carrier'] != null && isset($this->carriers[$this->state['carrier']])){
              $this->showPhoneConfirmation();
            }
            else{
              $this->addError('state.phone', 'The phone number provided is not compatible.');
              return;
            }
          }
        }
    }

    /**
     * Display phone number confirmation and text user
     * @return void
     */
    public function showPhoneConfirmation(){
      $phoneNumber = $this->state['phone'];
      $this->formattedPhoneNumber = '('.substr($phoneNumber, 0, 3).') '.substr($phoneNumber, 3, 3).'-'.substr($phoneNumber, 6, 10);
      $this->showingPhoneConfirmation = true;
      $this->emit('fixBody');
      $code = rand(100000,999999);
      $this->sendTextMessage($code);

      DB::table('two_factor_codes')->insert([
        'user_id' => Auth::User()->id,
        'two_factor_code' => $code,
      ]);
    }

    /**
     * Check verification code and save number
     * @return void
     */
    public function confirmVerification(){
      $user = Auth::User();

      $verify = DB::table('two_factor_codes')->where('user_id', Auth::User()->id)->first();

      if ($this->verificationCodeInput == $verify->two_factor_code){
        $user->phone = $this->state['phone'];
        $user->carrier = $this->state['carrier'];
        $user->save();
        $this->showingPhoneConfirmation = false;
        $this->emit('undofix');
        $this->emit('toastMessage', 'Phone number successfully verified');
      }
      else{
        $this->addError('verificationCodeInput', 'The verification code you inputted is incorrect');
      }
      $this->reset('verificationCodeInput');
    }

    /**
     * Send verification code textf
     * @param  int $code
     * @return void
     */
    public function sendTextMessage($code){
      $message = 'Hey there! Your verification code for Schedulist is '.$code.'. If you didn\'t request one feel free to ignore this text.';
      $email = $this->state['phone'].$this->carriers[$this->state['carrier']];
      $details = ['email' => $email, 'message' => $message];
      SendText::dispatchNow($details);
      $this->emit('countdownFunction');
    }

    /**
     * Cancels phone number validation and resets
     * @return void
     */
    public function cancelValidation(){
      $this->state['phone'] = Auth::User()->phone;
    }

    /**
     * Sends new verification code to user
     * @return void
     */
    public function resendAndCount(){
      $code = rand(100000,999999);
      $this->sendTextMessage($code);
      DB::table('two_factor_codes')->insert([
        'user_id' => Auth::User()->id,
        'two_factor_code' => $code,
      ]);
      $this->emit('toastMessage', 'A new verification code was sent');
    }

    /**
     * Validates phone number using Twilio
     * @param  string $number
     * @return void
     */
    public function validatePhoneNumber($number) {
      $sid = config('twilio.account_sid');
      $token = config('twilio.auth_token');
      $twilio = new Client($sid, $token);

      try{
        $phone_number = $twilio->lookups->v1->phoneNumbers($number)->fetch(["countryCode" => "US","type" => ["carrier"]]);
      } catch (Exception $e){
        if($e->getStatusCode() == 404) {
            $this->addError('state.phone', 'The phone number provided is invalid');
            $this->phoneError = true;
            return;
        } else {
            throw $e;
        }
      }
      $this->state['carrier'] = $phone_number->carrier['name'];
    }

    /**
     * Sets user grade value from select menu
     * @param string $grade
     */
    public function setGrade($grade){
      $this->state['grade_level'] = $grade;
    }

    public function render() {
        if (Auth::User()->profile_photo_path != null)
          $this->hasProfilePicture = true;
        else
          $this->hasProfilePicture = false;
        return view('livewire.profile.update-profile');
    }
}
