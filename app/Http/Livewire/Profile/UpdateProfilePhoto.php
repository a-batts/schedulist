<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UpdateProfilePhoto extends Component
{
    use WithFileUploads;

    /**
     * URL to user's current profile photo, or null if one is not set
     *
     * @var string
     */
    public string $profilePhotoUrl = '';

    /**
     * Whether or not the user has a profile picture
     *
     * @var boolean
     */
    public bool $hasProfilePicture = false;

    /**
     * The newly uploaded profile photo
     *
     * @var null|string|TemporaryUploadedFile
     */
    public null|string|TemporaryUploadedFile $uploadedPhoto = null;

    public array $errorMessages;

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->profilePhotoUrl =
            Auth::user()->profile_photo_path != null
                ? Auth::user()->profile_photo_url
                : '';
    }

    /**
     * Save the newly updated profile photo
     * @return void
     */
    public function save(): void
    {
        $user = Auth::user();

        // A photo has been uploaded, but the user has a profile picture set, so close the modal
        if ($this->profilePhotoUrl != null && $this->uploadedPhoto == null) {
            $this->dispatchBrowserEvent('close-photo-dialog');
            return;
        }
        // A photo has been uploaded, so save to server and update
        elseif ($this->uploadedPhoto != null) {
            $this->validate([
                'uploadedPhoto' =>
                    'image|max:2000|mimes:jpg,jpeg,png,gif|nullable',
            ]);

            $filename = $this->uploadedPhoto->store('public/profile-photos');
            Storage::delete('public/' . $user->profile_photo_path);

            $user->profile_photo_path = substr(
                $filename,
                strpos($filename, '/profile')
            );
            $user->save();

            $this->profilePhotoUrl = Auth::user()->profile_photo_url;
        } else {
            $user->profile_photo_path = null;
            $user->save();
        }
        $this->reset('profilePhotoUrl');
        $this->updateListeners();
        $this->dispatchBrowserEvent('close-photo-dialog');
    }

    /**
     * Remove the user's current profile photo
     *
     * @return void
     */
    public function removeProfilePhoto(): void
    {
        $user = Auth::user();

        Storage::delete('public/' . $user->profile_photo_path);
        $user->profile_photo_path = null;
        $user->save();

        $this->reset('profilePhotoUrl');
        $this->updateListeners();
        $this->dispatchBrowserEvent('clear-photo-picker');
        $this->dispatchBrowserEvent(
            'toastMessage',
            'Profile photo was successfully removed'
        );
    }

    /**
     * Update components that the user's profile picture has been updated
     *
     * @return void
     */
    private function updateListeners(): void
    {
        $this->emit('refresh-navigation-menu');
        $this->emit('refreshProfileCard');
    }

    /**
     * Recieve an error from FilePond
     *
     * @param string|null $message
     * @return void
     */
    public function filePondError(?string $message): void
    {
        $this->resetErrorBag('uploadedPhoto');
        throw ValidationException::withMessages([
            'uploadedPhoto' => $message,
        ]);
    }

    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->hasProfilePicture = isset(Auth::user()->profile_photo_path);
        $this->errorMessages = $this->getErrorBag()->toArray();
        return view('livewire.profile.update-profile-photo');
    }
}
