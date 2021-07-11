<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Auth;
use App\Models\User;

class SocialLogins extends Component
{
    /**
     * Remove Google account from user
     * @return [type]
     */
    public function disconnectGoogle(){
      $user = Auth::user();
      $user->google_email = null;
      $user->google_id = "0";
      $user->save();
      $this->emit('toastMessage', 'Sucessfully disconnected Google Account');
    }

    public function render(){
        return view('livewire.profile.social-logins');
    }
}
