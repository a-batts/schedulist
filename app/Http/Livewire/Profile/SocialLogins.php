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
    $user = Auth::user();
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
    return !(Auth::user()->google_id == "0" || Auth::user()->google_id == null);
  }

  public function render() {
    return view('livewire.profile.social-logins');
  }
}
