<?php

namespace App\Http\Livewire\Profile;

use App\Enums\User\GradeLevel;
use App\Helpers\CarrierEmailHelper;
use App\Services\Twilio\PhoneNumberLookupService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Twilio\Rest\Client;

class UpdateProfile extends Component {
  use WithRateLimiting;

  /**
   * Possible grade level options
   *
   * @var array
   */
  public array $gradeLevels;

  /**
   * The user's profile data
   *
   * @var array
   */
  public array $state = [];

  /**
   * The inputted verification code
   *
   * @var string
   */
  public string $verificationCodeInput = '';

  /**
   * Dash formatted version of the user's phone number
   *
   * @var string
   */
  public string $formattedPhoneNumber;

  public array $errorMessages;

  protected $listeners = ['refreshProfileCard' => '$refresh'];

  /**
   * Validation rules
   *
   * @return array
   */
  protected function rules(): array {
    return [
      'state.firstname' => 'required|string',
      'state.lastname' => 'required|string',
      'state.school' => 'nullable',
      'state.grade_level' => ['nullable', new Enum(GradeLevel::class)],
      'state.email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
      'state.phone' => 'nullable|digits:10',
      'verificationCodeInput' => 'digits:6',
    ];
  }

  /**
   * Validation messages
   *
   * @var array
   */
  protected array $messages = [
    'state.firstname.required' => 'Your first name is required',
    'state.lastname.required' => 'Your last name is required',
    'state.email.required' => 'An email address is required',
    'state.email.email' => 'Double check that the email address is valid',
    'state.email.unique' => 'Gadzooks, looks like that email is already in use. Your doppelgänger maybe?',
    'state.phone.digits' => 'Must be 10 digits long and not include dashes'
  ];

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->gradeLevels = $this->getGradeLevels();

    $this->state = Auth::user()->withoutRelations()->toArray();
  }

  /**
   * Save the user's updated profile information
   * @return void
   */
  public function save(): void {
    $user = Auth::user();

    if ($user->withoutRelations()->toArray() == $this->state) {
      $this->emit('toastMessage', 'No changes were made');
      return;
    }

    $this->validate();
    $user->forceFill([
      'firstname' => $this->state['firstname'],
      'lastname' => $this->state['lastname'],
      'email' => $this->state['email'],
      'school' => $this->state['school'],
      'grade_level' => $this->state['grade_level'],
    ])->save();

    if ($this->state['phone'] == '') {
      $user->phone = null;
      $user->save();
    }
    $this->emit('toastMessage', 'Profile changes saved');
    $this->emit('refresh-navigation-menu');

    if (Auth::user()->phone != $this->state['phone']) {
      $lookupService = new PhoneNumberLookupService(
        authSID: env('TWILIO_ACCOUNT_SID'),
        authToken: env('TWILIO_AUTH_TOKEN')
      );

      if ($lookupService->validate($this->state['phone'])) {
        $this->state['carrier'] = $lookupService->carrier;
        if (CarrierEmailHelper::getCarrierEmail($this->state['carrier']) !== null) {
          //Send a verification code and then show the verification popup
          $this->formattedPhoneNumber = $this->getFormattedNumber($this->state['phone']);
          $this->dispatchBrowserEvent('display-phone-verification');
          $this->sendVerificationCode($this->state['phone']);
        }
      } else
        $this->addError('state.phone', 'The phone number you entered is not compatible.');
    }
  }

  /**
   * Generate a verification code, send it to the user, and save it in the database
   *
   * @param string $number
   * @return void
   */
  protected function sendVerificationCode(string $number): void {
    try {
      $this->rateLimit(
        maxAttempts: 1,
        decaySeconds: 120
      );
      //Delete any prior verification codes
      DB::table('two_factor_codes')->where('user_id', Auth::id())->delete();
      $code = mt_rand(100000, 999999);

      DB::table('two_factor_codes')->insert([
        'user_id' => Auth::id(),
        'two_factor_code' => $code,
      ]);

      $client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));

      if (CarrierEmailHelper::getCarrierEmail($this->state['carrier']) == null)
        $this->addError('verificationCodeInput', 'The phone number you entered is not compatible.');
      else {
        $body = 'Hey there! Your verification code for Schedulist is ' . $code . '. If you didn\'t request one feel free to ignore this text.';
        $client->messages->create(
          $number,
          ['body' => $body, 'from' => env('TWILIO_PHONE_NUMBER', '+15715208808')]
        );
      }
    } catch (TooManyRequestsException $exception) {
      $this->dispatchBrowserEvent('set-timer', $exception->secondsUntilAvailable);
      throw ValidationException::withMessages([
        'verificationCodeInput' => "You need to wait another {$exception->secondsUntilAvailable} seconds before requesting a new code."
      ]);
    }
  }

  /**
   * Sends new verification code to user
   * @return void
   */
  public function resendCode() {
    $this->sendVerificationCode($this->state['phone']);
    $this->emit('toastMessage', 'A new verification code was sent');
  }

  /**
   * Validate the verification code and update the user's phone number if verified
   * @return void
   */
  public function confirmVerification(): void {
    $user = Auth::user();
    $verificationCode = DB::table('two_factor_codes')->where('user_id', Auth::id())->first()->two_factor_code;

    if ($this->verificationCodeInput == $verificationCode) {
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
   * Cancels phone number validation and resets
   * @return void
   */
  public function cancelValidation(): void {
    $this->state['phone'] = Auth::user()->phone;
  }

  /**
   * Get the formatted version of a provided phone number
   *
   * @param string $number
   * @return string
   */
  public function getFormattedNumber(string $number): string {
    return '(' . substr($number, 0, 3) . ') ' . substr($number, 3, 3) . '-' . substr($number, 6, 10);
  }

  /**
   * Get the array of all grade level enums 
   *
   * @return array
   */
  public function getGradeLevels(): array {
    $levels = [];
    foreach (GradeLevel::cases() as $case) {
      $levels[] =
        [
          'name' => $case->name,
          'value' => $case->value,
          'formatted_name' => $case->formattedName()
        ];
    }
    return $levels;
  }

  /**
   * Sets user grade value from select menu
   * @param int $grade
   */
  public function setGrade(int $grade): void {
    $this->state['grade_level'] = GradeLevel::from($grade);
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.profile.update-profile');
  }
}
