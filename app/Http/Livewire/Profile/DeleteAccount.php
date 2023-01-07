<?php

namespace App\Http\Livewire\Profile;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;
use ErrorException;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Component;

class DeleteAccount extends Component
{
    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Delete the specified user's data
     *
     * @param User $user
     * @return void
     */
    private function deleteUserData(User $user): void
    {
        //Delete assignments
        foreach ($user->assignments as $assignment) {
            $assignment->delete();
        }

        //Delete classes
        foreach ($user->classes as $class) {
            $class->delete();
        }

        //Delete class schedules
        $user->schedules()->delete();

        //Delete events, and the access to other events shared with this user
        Event::where('owner', $user->id)->delete();
        EventUser::where('user_id', $user->id)->delete();

        //Delete user backup if exists
        $archive = DB::table('user_archives')
            ->where('user_id', $user->id)
            ->first();
        if ($archive != null) {
            try {
                unlink(
                    storage_path('app/exported-archives/' . $archive->filename)
                );
            } catch (ErrorException) {
            }
            DB::table('user_archives')
                ->where('user_id', $user->id)
                ->delete();
        }
    }

    /**
     * Delete the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Jetstream\Contracts\DeletesUsers  $deleter
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $auth
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function deleteUser(
        Request $request,
        DeletesUsers $deleter,
        StatefulGuard $auth
    ) {
        $this->resetErrorBag();

        if (!Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [
                    'The password entered does not match your current password.',
                ],
            ]);
        }

        $this->deleteUserData(Auth::user());
        $deleter->delete(Auth::user()->fresh());
        $auth->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('landing');
    }

    /**
     * Return number of user's assignments
     *
     * @return int
     */
    public function getNumberAssignmentsProperty()
    {
        return Auth::user()
            ->assignments()
            ->count();
    }

    /**
     * Return number of user's classes
     *
     * @return int
     */
    public function getNumberClassesProperty()
    {
        return Auth::user()
            ->classes()
            ->count();
    }

    /**
     * Return number of user's events
     *
     * @return int
     */
    public function getNumberEventsProperty()
    {
        return Auth::user()
            ->events()
            ->count();
    }

    public function render()
    {
        return view('livewire.profile.delete-account')
            ->layout('layouts.app')
            ->layoutData(['title' => 'Delete Account']);
    }
}
