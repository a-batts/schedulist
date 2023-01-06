<?php

namespace App\Http\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\User\GradeLevel;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
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
  public GradeLevel $gradeLevel = GradeLevel::College;

  /** @var array<GradeLevel> */
  public array $gradeLevels;

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
      'gradeLevel' => ['nullable', new Enum(GradeLevel::class)],
      'school' => ['nullable'],
    ];
  }

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->gradeLevels = $this->getGradeLevels();
  }

  /**
   * Create a new user and sign them in to the app
   *
   * @return
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
   * Sets user grade value from select menu
   * @param int $grade
   */
  public function setGrade(int $grade): void {
    $this->gradeLevel = GradeLevel::from($grade);
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
