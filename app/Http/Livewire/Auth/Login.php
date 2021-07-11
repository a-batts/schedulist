<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Auth;

use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;

use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    public $errorMessages = [];

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate(){
      $this->validate();

      if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
          $this->addError('email', trans('auth.failed'));
          return;
      }
      return redirect()->intended(route('dashboard'));
    }

    public function render(){
      $this->errorMessages = $this->getErrorBag()->toArray();
      return view('livewire.auth.login')->layout('layouts.guest', ['title' => 'Login']);
    }
}
