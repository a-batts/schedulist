<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SocialLogins extends Component {

  /**
   * Remove Google account from user
   * @return void
   */
  public function disconnectGoogle(): void {
    $user = Auth::User();
    $user->google_email = null;
    $user->google_id = "0";
    $user->save();
    $this->emit('toastMessage', 'Sucessfully disconnected Google Account');
  }

  /**
   * Determine if the user has a Google account linked
   *
   * @return boolean
   */
  public function getHasGoogleAccountProperty(): bool {
    return !(Auth::User()->google_id == "0" || Auth::User()->google_id == null);
  }

  public function render() {
    return view('livewire.profile.social-logins');
  }
}
