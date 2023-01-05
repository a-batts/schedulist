<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Actions\Core\NotifyUser;

class UpdatePassword extends Component {

  public $password;
  public $passwordConfirmation;

  public bool $settingNewPassword = false;

  public array $errorMessages;

  protected function rules() {
    return [
      'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
      'passwordConfirmation' => 'required|string|same:password'
    ];
  }

  protected $messages = [
    'password.required' => 'A new password is required',
    'password.regex' => 'Must be at least 10 characters and contain one uppercase letter, a number and a symbol',
    'passwordConfirmation.required' => 'Make sure to confirm your password',
    'passwordConfirmation.same' => 'Password confirmation does not match',
  ];

  /**
   * Mount Component
   * @return void
   */
  public function mount() {
    if (!isset(Auth::user()->password) || Auth::user()->password == '')
      $this->settingNewPassword = true;
  }

  public function updatedPassword($value) {
    $this->clearValidation('password');

    if (strlen($value) < 10)
      $this->addError('password', 'Password is too short, needs to be at least 10 characters');
    elseif (!preg_match('/[a-z]+/', $value))
      $this->addError('password', 'Your password needs at least one lowercase letter');
    elseif (!preg_match('/[A-Z]+/', $value))
      $this->addError('password', 'Your password needs at least one uppercase letter');
    elseif (!preg_match('/[0-9]+/', $value))
      $this->addError('password', 'Your password needs at least one number');
    elseif (!preg_match('/[@$!%*?&]+/', $value))
      $this->addError('password', 'Your password needs at least special character');
  }

  public function updatedPasswordConfirmation($value) {
    $this->clearValidation('password');

    if ($value != $this->password)
      $this->addError('passwordConfirmation', 'Password confirmation does not match');
  }

  public function save() {
    $this->validate();

    if (Hash::check($this->password, Auth::user()->password)) {
      $this->addError('password', 'Your new password should be different than your old password');
    } elseif ($this->password == $this->passwordConfirmation) {
      $user = Auth::user();
      if (!$this->settingNewPassword) {
        $userSettings = Auth::user()->settings;

        if ($userSettings->account_alert_texts === 1) {
          $message = ('The password for your Schedulist account was just updated. If that wasn\'t you, you should recover your password as soon as possible.');
          NotifyUser::createNotification($message, Auth::user())->sendText()->addText(route('password.request'));
        }

        if ($userSettings->account_alert_emails === 1) {
          $message = [
            'heading' => 'Password was changed',
            'body' => 'Your Schedulist password was just changed. If this was you, you can safely ignore this message. If you did not just update your password, someone else has access to your account, and you should reset your password as soon as possible.',
            'link' => route('password.request'),
            'link_title' => 'Password reset',
            'subject' => 'Security alert - Account password changed',
            'footer' => 'You received this email because you turned on email alerts for account updates.',
            'icon' => 'lock'
          ];
          NotifyUser::createNotification($message, Auth::user())->sendEmail();
        }
      }

      $user->forceFill([
        'password' => Hash::make($this->password),
      ])->save();
      $this->emit('toastMessage', 'Password successfully updated');
      $this->reset(['password', 'passwordConfirmation']);
      if ($this->settingNewPassword)
        return redirect()->route('profile');
    } else
      $this->addError('passwordConfirmation', 'Password confirmation does not match');
  }

  public function render() {
    if (!$this->settingNewPassword)
      $title = 'Update Account Password';
    else
      $title = 'Set Account Password';
    $this->errorMessages = $this->getErrorBag()->toArray();

    return view('livewire.profile.update-password')
      ->layout('layouts.app')
      ->layoutData(['title' => $title]);
  }
}
