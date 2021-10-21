<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Core\NotifyUser;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationSettings extends Component {
  public $userSettings;

  protected $rules = [
    'userSettings.account_alert_texts' => 'boolean|required',
  ];

  /**
   * Mount component
   * @return void
   */
  public function mount() {
    $userSettings = Auth::user()->settings()->first();
    if ($userSettings == null) {
      $userSettings = new UserSettings();
      $userSettings->user_id = Auth::user()->id;
      $userSettings->save();
    }

    $this->userSettings = $userSettings;

    //$this->accountAlertMessages = boolval($this->userSettings->account_texts_enabled);
    //$this->assignmentAlertMessages = boolval($this->userSettings->assignment_texts_enabled);
  }

  /**
   * Toggle notification settings
   * @param  string $component
   * @return void
   */
  public function toggle($component) {
    $userSettings = $this->userSettings;
    $userSettings[$component] = !$userSettings[$component];
    $userSettings->save();

    $this->emit('toastMessage', 'Preferences were saved');

    if ($component == 'account_alert_texts' && $userSettings->account_alert_texts === false) {
      $message = ('SMS account alerts were just disabled for your Schedulist account. If this wasn\'t you, reset your password ASAP.');
      $notification = NotifyUser::createNotification($message, Auth::user())->sendText();
    } elseif ($component == 'account_alert_emails' && $userSettings->account_alert_emails === false) {
      $message = [
        'alert' => 'Account status emails were disabled',
        'body' => 'Email alerts for important security alerts about your Schedulist account were just turned off. If that wasn\'t you, you should reset your password as soon as possible.',
        'link' => route('profile'),
        'link_title' => 'Go to account settings',
        'subject' => 'Security alert - Account status emails disabled',
      ];
      $notification = NotifyUser::createNotification($message, Auth::user())->sendEmail('security-alert');
    }
  }

  /**
   * Return formatted phone number for display
   * @return string
   */
  public function getFormattedPhoneNumberProperty() {
    $phoneNumber = Auth::user()->phone;
    return '(' . substr($phoneNumber, 0, 3) . ') ' . substr($phoneNumber, 3, 3) . '-' . substr($phoneNumber, 6, 4);
  }

  public function render() {
    return view('livewire.profile.notification-settings ');
  }
}
