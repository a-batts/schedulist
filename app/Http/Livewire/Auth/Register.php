<?php

namespace App\Http\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;

use App\Models\User;

use App\Providers\RouteServiceProvider;

use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Laravel\Fortify\Contracts\CreatesNewUsers;

use Livewire\Component;

class Register extends Component
{
    use PasswordValidationRules;

    public $firstName;
    public $lastName;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $passwordConfirmation;

    public bool $requiredFilled = false;

    public $gradeLevel;
    public $school;
    public $errorMessages;
    private $possibleGrades = ['es', 'ms', 'hs', 'university', 'other'];

    protected $messages = [
      'password.regex' => 'Double check that your password is 10+ characters and contains an uppercase letter, number, and special character',
      'firstName.required' => 'Required',
      'lastName.required' => 'Required',
    ];

    function rules(){
      return[
        'firstName' => ['required', 'max:50'],
        'lastName' => ['required', 'max:50'],
        'email' => ['required', 'email', 'max:255', 'unique:users'],
        'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
        'passwordConfirmation' => 'required|string|same:password',
        'gradeLevel' => ['required'],
        'school' => ['nullable'],
      ];
    }

    public function create(){
        $this->validate([
            'firstName' => ['required', 'max:50'],
            'lastName' => ['required', 'max:50'],
            'password' => ['required', 'string', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/'],
            'passwordConfirmation' => ['required', 'string', 'same:password'],
            'gradeLevel' => ['required'],
        ]);

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

    public function setGradeLevel($grade){
      $this->resetErrorBag('gradeLevel');
      if (in_array($grade, $this->possibleGrades)){
        $this->gradeLevel = $grade;
        if (isset($this->firstName, $this->lastName, $this->email, $this->password, $this->passwordConfirmation, $this->gradeLevel))
          $this->requiredFilled = true;
      }
      else
        $this->addError('gradeLevel', 'Invalid grade level');
    }

    public function updated($propertyName){
      $this->validateOnly($propertyName);

      if (isset($this->firstName, $this->lastName, $this->email, $this->password, $this->passwordConfirmation, $this->gradeLevel))
        $this->requiredFilled = true;
    }

    public function render(){
      $this->errorMessages = $this->getErrorBag()->toArray();
      return view('livewire.auth.register')->layout('layouts.guest', ['title' => 'Register']);
    }
}
