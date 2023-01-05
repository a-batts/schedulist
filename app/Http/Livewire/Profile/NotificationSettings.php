<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Core\NotifyUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationSettings extends Component {
  public $userSettings;

  protected $rules = [
    'userSettings.account_alert_texts' => 'boolean|required',
  ];

  protected $listeners = ['refreshNotificationOptions' => '$refresh'];

  /**
   * Mount component
   * @return void
   */
  public function mount(): void {
    $userSettings = Auth::user()->settings;
    if ($userSettings == null)
      $userSettings = Auth::user()->settings()->create();

    $this->userSettings = $userSettings;
  }

  /**
   * Toggle notification settings
   * @param  string $component
   * @return void
   */
  public function toggle($component): void {
    $userSettings = $this->userSettings;

    $userSettings[$component] = !boolval($userSettings[$component]);
    $userSettings->save();
    $this->emit('toastMessage', 'Preferences were saved');

    switch ($component) {
      case 'account_alert_texts':
        if ($userSettings->account_alert_texts === false) {
          $message = ('SMS account alerts were just disabled for your Schedulist account. If this wasn\'t you, reset your password ASAP.');
          NotifyUser::createNotification($message, Auth::user())->sendText();
        }
        break;
      case 'account_alert_emails':
        if ($userSettings->account_alert_emails === false) {
          $data = [
            'heading' => 'Account status emails were disabled',
            'body' => 'Email security alerts for your Schedulist account were just disabled. If you didn\'t perform this action, your account may be compromised.',
            'link' => route('profile'),
            'link_title' => 'Go to account settings',
            'footer' => 'You received this email because you turned on email alerts for account updates.',
            'subject' => 'Security alert - Account status emails disabled',
            'icon' => 'security'
          ];
          NotifyUser::createNotification($data, Auth::user())->sendEmail();
        }
        break;
    }
  }

  /**
   * Return formatted phone number for display
   * @return string
   */
  public function getFormattedPhoneNumberProperty(): string {
    $phoneNumber = Auth::user()->phone;
    return '(' . substr($phoneNumber, 0, 3) . ') ' . substr($phoneNumber, 3, 3) . '-' . substr($phoneNumber, 6, 4);
  }

  public function render() {
    $this->hasPhoneNumber = isset(Auth::user()->phone);
    return view('livewire.profile.notification-settings');
  }
}
