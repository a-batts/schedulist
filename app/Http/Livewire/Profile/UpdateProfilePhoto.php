<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfilePhoto extends Component {
  use WithFileUploads;

  public $errorMessages;
  public $profilePhoto;
  public $hasProfilePicture = false;
  public $profilePhotoUrl;

  protected $listeners = ['filePondError'];


  public function mount() {
    if (Auth::User()->profile_photo_path == null)
      $this->profilePhotoUrl == null;
    else
      $this->profilePhotoUrl = Auth::User()->profile_photo_url;
  }

  /**
   * Save the new picture
   * @return void
   */
  public function save() {
    if (Auth::User()->profile_photo_path == $this->profilePhoto) {
      $this->dispatchBrowserEvent('close-photo-dialog');
      $this->emit('refreshProfileCard');
      $this->emit('refresh-navigation-menu');
      return;
    }
    $user = Auth::User();
    if ($this->profilePhotoUrl != null && $this->profilePhoto == null) {
      $this->dispatchBrowserEvent('close-photo-dialog');
      $this->emit('refreshProfileCard');
      $this->emit('refresh-navigation-menu');
      return;
    } elseif ($this->profilePhoto != null) {
      $this->validate([
        'profilePhoto' => 'image|max:2000|mimes:jpg,jpeg,png,gif|nullable',
      ]);

      $filename = $this->profilePhoto->store('public/profile-photos');
      Storage::delete('public/' . $user->profile_photo_path);

      $user->profile_photo_path = substr($filename, strpos($filename, '/profile'));
      $user->save();

      $this->profilePhotoUrl = Auth::User()->profile_photo_url;
    } else {
      $user->profile_photo_path = null;
      $user->save();

      $this->profilePhotoUrl == null;
    }
    $this->dispatchBrowserEvent('close-photo-dialog');
    $this->emit('refreshProfileCard');
    $this->emit('refresh-navigation-menu');
  }

  public function filePondError($e) {
    $this->resetErrorBag('profilePhoto');
    $this->addError('profilePhoto', $e);
  }

  public function removeProfilePhoto() {
    $user = Auth::user();
    $user->profile_photo_path = null;
    $user->save();

    $this->profilePhotoUrl == null;
    $this->dispatchBrowserEvent('toastMessage', 'Profile photo was successfully removed');
  }

  public function render() {
    if (Auth::User()->profile_photo_path != null)
      $this->hasProfilePicture = true;
    else
      $this->hasProfilePicture = false;
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.profile.update-profile-photo');
  }
}
