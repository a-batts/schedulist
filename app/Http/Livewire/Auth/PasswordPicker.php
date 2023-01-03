<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;

use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class PasswordPicker extends Component {
  public $userData;

  public $password;

  public $passwordConfirmation;

  public $errorMessages;

  protected $messages = [
    'password.regex' => 'Double check that your password is 10+ characters and contains an uppercase letter, number, and special character',
  ];

  protected function rules() {
    return [
      'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
      'passwordConfirmation' => 'required|string|same:password',
    ];
  }

  public function save() {
    $this->validate();

    $userData = $this->userData;

    $user = new User;
    $user->firstname = $userData['given_name'];
    $user->lastname = $userData['family_name'];
    $user->email = $userData['email'];
    $user->google_email = $userData['email'];
    $user->google_id = $userData['sub'];

    $this->user = $user;
    $user->password = Hash::make($this->password);
    $user->save();

    event(new Registered($user));

    Auth::login($user, true);

    return redirect()->intended(route('dashboard'));
  }

  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.auth.password-picker');
  }
}
