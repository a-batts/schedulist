<?php

namespace App\Http\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Register extends Component {
  use PasswordValidationRules;

  /** @var string */
  public string $firstName = '';

  /** @var string */
  public string $lastName = '';

  /** @var string */
  public string $email = '';

  /** @var string */
  public string $password = '';

  /** @var string */
  public string $passwordConfirmation = '';

  /** @var string */
  public string $school = '';

  /** @var string */
  public string $gradeLevel = '';

  /** @var array */
  public array $errorMessages = [];

  /**
   * Array of the different grade levels, and their corresponding database representation
   *
   * @var array
   */
  public array $gradeOptions = [
    'Elementary School' => 'es',
    'Middle School' => 'ms',
    'High School' => 'hs',
    'College' => 'university',
    'Other' => 'other'
  ];

  /**
   * Validation messages
   *
   * @var array
   */
  protected array $messages = [
    'password.regex' => 'Double check that your password is 10+ characters and contains an uppercase letter, number, and special character',
    'firstName.required' => 'Required',
    'lastName.required' => 'Required',
  ];

  /**
   * Validation rules
   *
   * @return array
   */
  protected function rules(): array {
    return [
      'firstName' => ['required', 'max:50'],
      'lastName' => ['required', 'max:50'],
      'email' => ['required', 'email', 'max:255', 'unique:users'],
      'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
      'passwordConfirmation' => 'required|string|same:password',
      'gradeLevel' => ['required'],
      'school' => ['nullable'],
    ];
  }

  /**
   * Create the new user
   *
   * @return \Livewire\Redirector
   */
  public function create() {
    $this->validate();

    $user = User::create([
      'firstname' => $this->firstName,
      'lastname' => $this->lastName,
      'email' => $this->email,
      'password' => Hash::make($this->password),
      'grade_level' => $this->gradeLevel,
      'school' => $this->school,
    ]);

    event(new Registered($user));

    Auth::login($user, true);

    return redirect()->intended(route('dashboard'));
  }

  /**
   * Set the user's grade level
   *
   * @param string $level
   * @return void
   */
  public function setGradeLevel(string $level): void {
    if (!isset($this->gradeOptions[$level]))
      throw ValidationException::withMessages([
        'gradeLevel' => 'Invalid grade level'
      ]);
    $this->gradeLevel = $this->gradeOptions[$level];
  }

  /**
   * Validate the updated property
   *
   * @param string $propertyName
   * @return void
   */
  public function updated(string $propertyName): void {
    $this->validateOnly($propertyName);
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.auth.register')->layout('layouts.guest', ['title' => 'Register']);
  }
}
