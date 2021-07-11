<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use DB;

class DeleteUserData extends Component
{
    public $confirmingDataDeletion = false;

    public $password = '';

    /**
     * Confirm the deletion of user data
     * @return void
     */
    public function confirmDataDeletion(){
      $this->password = '';
      $this->dispatchBrowserEvent('confirming-delete-user');
      $this->confirmingDataDeletion = true;
    }

    /**
     * Delete user data if password is correct
     * @param  StatefulGuard $auth
     * @return void
     */
    public function deleteData(StatefulGuard $auth){
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        DB::table('classes')->where('userid', Auth::user()->id)->delete();
        DB::table('assignments')->where('userid', Auth::user()->id)->delete();

        $this->confirmingDataDeletion = false;
        $this->emit('deletedData');
        $this->emit('toastMessage', 'Account data was deleted');

    }

    public function render(){
        return view('livewire.profile.delete-user-data');
    }
}
