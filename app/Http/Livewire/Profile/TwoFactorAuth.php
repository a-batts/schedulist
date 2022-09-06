<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Laravel\Fortify\Features;
use Laravel\Jetstream\ConfirmsPasswords;
use Livewire\Component;
use App\Actions\Core\NotifyUser;

class TwoFactorAuth extends Component {
    use ConfirmsPasswords;

    /**
     * Indicates if two factor authentication QR code is being displayed.
     *
     * @var bool
     */
    public $showingQrCode = false;

    /**
     * Indicates if two factor authentication recovery codes are being displayed.
     *
     * @var bool
     */
    public $showingRecoveryCodes = false;

    /**
     * Enable two factor authentication for the user.
     *
     * @param  \Laravel\Fortify\Actions\EnableTwoFactorAuthentication  $enable
     * @return void
     */
    public function enableTwoFactorAuthentication(EnableTwoFactorAuthentication $enable) {
        if (Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'))
            $this->ensurePasswordIsConfirmed();

        $enable(Auth::user());

        $this->showingQrCode = true;
        $this->showingRecoveryCodes = true;

        $userSettings = Auth::user()->settings()->first();
        if ($userSettings->account_alert_texts === 1) {
            $message = ('Two factor authentication was just turned on for your account. You\'ll need to enter a 2FA code for future sign ins.');
            $notification = NotifyUser::createNotification($message, Auth::user())->sendText();
        }
        if ($userSettings->account_alert_emails === 1) {
            $message = [
                'alert' => 'Two factor authentication turned on',
                'body' => 'Two factor authentication was just turned on for your account. You\'ll need to enter a code from your 2FA app for future sign ins. If you haven\'t already, make sure to save a copy of your backup codes in a safe place. You can also turn 2FA back off at any time in account security settings.',
                'link' => route('account.two-factor'),
                'link_title' => '2FA Settings',
                'subject' => 'Security alert - 2FA enabled',
            ];
            $notification = NotifyUser::createNotification($message, Auth::user())->sendEmail('security-alert');
        }
    }

    public function changeTwoFactorDevice(EnableTwoFactorAuthentication $enable, DisableTwoFactorAuthentication $disable) {
        $this->disableTwoFactorAuthentication($disable);
        $this->enableTwoFactorAuthentication($enable);
        $this->emit('toastMessage', 'QR code was updated. You can now add your account to your new device.');
    }

    /**
     * Display the user's recovery codes.
     *
     * @return void
     */
    public function showRecoveryCodes() {
        if (Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'))
            $this->ensurePasswordIsConfirmed();

        $this->showingRecoveryCodes = true;
    }

    /**
     * Generate new recovery codes for the user.
     *
     * @param  \Laravel\Fortify\Actions\GenerateNewRecoveryCodes  $generate
     * @return void
     */
    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate) {
        if (Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'))
            $this->ensurePasswordIsConfirmed();

        $generate(Auth::user());

        $this->showingRecoveryCodes = true;
        $this->emit('toastMessage', 'New recovery codes generated.');
    }

    /**
     * Disable two factor authentication for the user.
     *
     * @param  \Laravel\Fortify\Actions\DisableTwoFactorAuthentication  $disable
     * @return void
     */
    public function disableTwoFactorAuthentication(DisableTwoFactorAuthentication $disable) {
        if (Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'))
            $this->ensurePasswordIsConfirmed();

        $disable(Auth::user());

        $userSettings = Auth::user()->settings()->first();
        if ($userSettings->account_alert_texts === 1) {
            $message = ('Two factor authentication was just turned on for your account. You\'ll need to enter a 2FA code for future sign ins.');
            $notification = NotifyUser::createNotification($message, Auth::user())->sendText();
        }
        if ($userSettings->account_alert_emails === 1) {
            $message = [
                'alert' => 'Two factor authentication turned off',
                'body' => 'Two factor authentication was just turned off for your account. You can turn it back on at any time in account security settings.',
                'link' => route('account.two-factor'),
                'link_title' => '2FA Settings',
                'subject' => 'Security alert - 2FA disabled',
            ];
            $notification = NotifyUser::createNotification($message, Auth::user())->sendEmail('security-alert');
        }
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty() {
        return Auth::user();
    }

    /**
     * Determine if two factor authentication is enabled.
     *
     * @return bool
     */
    public function getEnabledProperty() {
        return !empty($this->user->two_factor_secret);
    }

    public function render() {
        return view('livewire.profile.two-factor-auth')
            ->layout('layouts.app')
            ->layoutData(['title' => '  Two-Factor Authentication']);
    }
}
