<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Auth;
use App\Model\Users;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Component
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordComf;

    function rules(){
      return [
          'currentPassword' => 'nullable|string',
          'newPassword' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
          'newPasswordComf' => 'required|string|same:newPassword'
      ];
    }

    protected $messages = [
        'newPassword.required' => 'A new password is required',
        'newPassword.regex' => 'Must be at least 10 characters and contain one uppercase letter, a number and a symbol',
        'newPasswordComf.required' => 'Make sure to confirm your new password',
        'newPasswordComf.same' => 'Passwords don\'t match'
    ];

    /**
     * Mount Component
     * @return void
     */
    public function mount(){
      $this->currentPassword = '';
      $this->newPassword = '';
      $this->newPasswordComf = '';
    }

    /**
     * Validate updated properties
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    /**
     * Validate that the old password is entered
     * @return void
     */
    public function updatedCurrentPassword(){
      if($this->currentPassword == null || $this->currentPassword == '')
        $this->addError('currentPassword', 'Your old password is required');
    }

    /**
     * Save the new password on validation
     * @return void
     */
    public function save(){
      $this->validate();
      $user = Auth::user();
      //Check to see if password is being updated or if password is being set
      if (Auth::user()->password != null){
        if($this->currentPassword == null || $this->currentPassword == ''){
          $this->addError('currentPassword', 'Your old password is required');
          return;
        }
        if(! Hash::check($this->currentPassword, $user->password)){
          $this->addError('currentPassword', 'The inputted password does not match your current one');
          return;
        }
        elseif($this->currentPassword == $this->newPassword){
          $this->addError('newPassword', 'Make sure your new password is not the same as the old one.');
          return;
        }
        else{
          $user->forceFill([
              'password' => Hash::make($this->newPassword),
          ])->save();
          $this->emit('toastMessage', 'Password successfully updated');
          $this->reset(['oldPassword', 'newPassword', 'newPasswordComf']);
        }
      }
      //Password does not exist condition
      else{
        $user->forceFill([
            'password' => Hash::make($this->newPassword),
        ])->save();
        $this->emit('toastMessage', 'Password successfully set');
        $this->reset(['oldPassword', 'newPassword', 'newPasswordComf']);

      }
    }

    public function render(){
        return view('livewire.profile.update-password');
    }
}
