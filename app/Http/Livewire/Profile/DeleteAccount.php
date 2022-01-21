<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Component;

class DeleteAccount extends Component {

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Delete the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Jetstream\Contracts\DeletesUsers  $deleter
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $auth
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function deleteUser(Request $request, DeletesUsers $deleter, StatefulGuard $auth) {
        $this->resetErrorBag();

        if (!Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $deleter->delete(Auth::user()->fresh());
        $auth->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect('/');
    }

    /**
     * Return number of user's assignments
     *
     * @return int
     */
    public function getNumberAssignmentsProperty() {
        return Auth::user()->assignments()->count();
    }

    /**
     * Return number of user's classes
     *
     * @return int
     */
    public function getNumberClassesProperty() {
        return Auth::user()->classes()->count();
    }

    /**
     * Return number of user's events
     *
     * @return int
     */
    public function getNumberEventsProperty() {
        return Auth::user()->events()->count();
    }

    public function render() {
        return view('livewire.profile.delete-account')
            ->layout('layouts.app')
            ->layoutData(['title' => 'Delete Account']);
    }
}
