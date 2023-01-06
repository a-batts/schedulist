<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ConfirmPassword extends Component {
  public $userData;

  public $password;

  public $errorMessages;

  protected $rules = [
    'password' => ['required'],
  ];

  public function authenticate() {
    $this->validate();

    if (!Auth::attempt(['email' => $this->userData['email'], 'password' => $this->password], 'true'))
      throw ValidationException::withMessages([
        'password' => 'That password doesn\'t match what we have on file'
      ]);

    $userData = $this->userData;

    $user = User::where('email', $userData['email'])->first();
    $user->google_email = $userData['email'];
    $user->google_id = $userData['sub'];
    $user->save();

    return redirect()->intended(route('dashboard'));
  }

  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.auth.confirm-password');
  }
}
