<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Actions\Core\NotifyUser;
use Illuminate\Validation\ValidationException;

class UpdatePassword extends Component
{
    /**
     * New password
     *
     * @var string
     */
    public string $password;

    /**
     * New password confirmation
     *
     * @var string
     */
    public string $passwordConfirmation;

    /**
     * Whether the user is setting a new password or updating their existing one
     *
     * @var boolean
     */
    public bool $settingNewPassword = false;

    public array $errorMessages;

    /**
     * Validation rules
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'password' =>
                'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
            'passwordConfirmation' => 'required|string|same:password',
        ];
    }

    /**
     * Validation messages
     *
     * @var array
     */
    protected array $messages = [
        'password.required' => 'A new password is required',
        'password.regex' =>
            'Must be at least 10 characters and contain one uppercase letter, a number and a symbol',
        'passwordConfirmation.required' => 'Make sure to confirm your password',
        'passwordConfirmation.same' => 'Password confirmation does not match',
    ];

    /**
     * Mount the component
     * @return void
     */
    public function mount(): void
    {
        $this->settingNewPassword =
            !isset(Auth::user()->password) || Auth::user()->password == '';
    }

    public function updatedPassword($value): void
    {
        $this->clearValidation('password');
        if (strlen($value) < 10) {
            throw ValidationException::withMessages([
                'password' =>
                    'Password is too short, needs to be at least 10 characters',
            ]);
        }
        if (!preg_match('/[a-z]+/', $value)) {
            throw ValidationException::withMessages([
                'password' =>
                    'Your password needs at least one lowercase letter',
            ]);
        }
        if (!preg_match('/[A-Z]+/', $value)) {
            throw ValidationException::withMessages([
                'password' =>
                    'Your password needs at least one uppercase letter',
            ]);
        }
        if (!preg_match('/[0-9]+/', $value)) {
            throw ValidationException::withMessages([
                'password' => 'Your password needs at least one number',
            ]);
        }
        if (!preg_match('/[@$!%*?&]+/', $value)) {
            throw ValidationException::withMessages([
                'password' => 'Your password needs at least special character',
            ]);
        }
    }

    public function updatedPasswordConfirmation(): void
    {
        $this->validateOnly('passwordConfirmation');
    }

    public function save()
    {
        $this->validate();
        if (Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' =>
                    'Your new password should be different than your old password',
            ]);
        }

        $user = Auth::user();

        if (!$this->settingNewPassword) {
            $userSettings = Auth::user()->settings;

            if ($userSettings->account_alert_texts === 1) {
                NotifyUser::createNotification(
                    'The password for your Schedulist account was just updated. If that wasn\'t you, 
                you should recover your password as soon as possible.',
                    Auth::user()
                )
                    ->sendText()
                    ->addText(route('forgot-password'));
            }

            if ($userSettings->account_alert_emails === 1) {
                NotifyUser::createNotification(
                    [
                        'heading' => 'Password was changed',
                        'body' =>
                            'Your Schedulist password was just changed. If this was you, you can safely ignore this message. If you did not just update your password, someone else has access to your account, and you should reset your password as soon as possible.',
                        'link' => route('forgot-password'),
                        'link_title' => 'Password reset',
                        'subject' =>
                            'Security alert - Account password changed',
                        'footer' =>
                            'You received this email because you turned on email alerts for account updates.',
                        'icon' => 'lock',
                    ],
                    Auth::user()
                )->sendEmail();
            }
        }

        $user
            ->forceFill([
                'password' => Hash::make($this->password),
            ])
            ->save();

        $this->emit('toastMessage', 'Password successfully updated');
        return redirect()->route('profile');
    }

    public function render()
    {
        $this->errorMessages = $this->getErrorBag()->toArray();

        return view('livewire.profile.update-password')
            ->layout('layouts.app')
            ->layoutData([
                'title' => $this->settingNewPassword
                    ? 'Set Account Password'
                    : 'Update Account Password',
            ]);
    }
}
