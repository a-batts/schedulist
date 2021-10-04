<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Jobs\SendText;
use Auth;
use Mail;
use Config;
use DB;

class ManageTexts extends Component {
  protected $userSettings;
  public $formattedPhoneNumber;

  public $accountAlertMessages = false;
  public $assignmentAlertMessages = false;

  protected $carriers = [
    'Verizon Wireless' => '@vtext.com',
    'T-Mobile' => '@tmomail.net',
    'T-Mobile USA, Inc.' => '@tmomail.net',
    'AT&T Wireless' => '@txt.att.net',
    'Sprint' => '@messaging.sprintpcs.com',
    'Google (Grand Central) BWI - Bandwidth.com - SVR' => null,

  ];

  /**
   * Mount component
   * @return void
   */
  public function mount() {
    if (!DB::table('user_settings')->where('user_id', Auth::user()->id)->exists())
      DB::table('user_settings')->insert([
        'user_id' => Auth::user()->id
      ]);

    $phoneNumber = Auth::User()->phone;
    $this->formattedPhoneNumber = '(' . substr($phoneNumber, 0, 3) . ') ' . substr($phoneNumber, 3, 3) . '-' . substr($phoneNumber, 6, 10);

    $this->userSettings = DB::table('user_settings')->where('user_id', Auth::user()->id)->first();
    $this->accountAlertMessages = boolval($this->userSettings->account_texts_enabled);
    $this->assignmentAlertMessages = boolval($this->userSettings->assignment_texts_enabled);
  }

  /**
   * Switch value of settings on toggle
   * @param  string $component
   * @return void
   */
  public function toggle($component) {
    if ($component == 'account') {
      $this->accountAlertMessages = !$this->accountAlertMessages;
      $this->userSettings = DB::table('user_settings')->where('user_id', Auth::user()->id)->update(['account_texts_enabled' => (int) $this->accountAlertMessages]);
    } else if ($component == 'assignment') {
      $this->assignmentAlertMessages = !$this->assignmentAlertMessages;
      $this->userSettings = DB::table('user_settings')->where('user_id', Auth::user()->id)->update(['assignment_texts_enabled' => (int) $this->assignmentAlertMessages]);
    }
    $this->emit('toastMessage', 'Updated preferences');

    if ($component == 'account' && $this->accountAlertMessages == false)
      $this->sendMessage('SMS notifications for account alerts were just disabled. If this wasn\'t you, reset your password ASAP.');
  }

  /**
   * Get email address from carrier name
   * @return void
   */
  public function getCarrierEmail() {
    $number = Auth::User()->phone;
    $carrier = $this->carriers[Auth::User()->carrier];
    return $number . $carrier;
  }

  /**
   * Handle mail sending
   * @param  string $message
   * @return void
   */
  public function sendMessage($message) {
    $details = ['email' => $this->getCarrierEmail(), 'message' => $message];
    SendText::dispatchNow($details);
  }

  public function render() {
    return view('livewire.profile.manage-texts');
  }
}
