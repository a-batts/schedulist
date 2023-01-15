<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventInviteController;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Contact\ContactForm;
use App\Http\Livewire\Profile\DeleteAccount;
use App\Http\Livewire\Profile\LogoutOtherSessions;
use App\Http\Livewire\Profile\MyData;
use App\Http\Livewire\Profile\Schedule\EditSchedules;
use App\Http\Livewire\Profile\TwoFactorAuth;
use App\Http\Livewire\Profile\UpdatePassword;
use App\Http\Livewire\Schedule\EventInvite;
use App\Models\Classes;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('dashboard', function () {
        return view('livewire.dashboard');
    })
    ->name('dashboard');

Route::redirect('app', 'dashboard');

Route::get('offline', function () {
    return view('offline');
});

Route::get('privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name(
    'google-login'
);

Route::get('login/callback/google', [
    AuthController::class,
    'handleGoogleCallback',
]);

Route::post('login/callback/onetap', [
    AuthController::class,
    'handleOneTapCallback',
]);

Route::get('login/set-password', function () {
    return view('auth.set-password');
})->name('set-password');

Route::get('login/confirm-password', function () {
    return view('auth.confirm-linking');
})->name('confirm-link');

Route::get('login/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('logout', function () {
    return redirect()->intended('login');
});

Route::get('register', Register::class)->name('register');

Route::get('contact', ContactForm::class)->name('contact');

//Routes requiring the user to be logged in and verified

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('account', function () {
        return redirect('settings/account');
    });

    Route::get('settings/profile', function () {
        return redirect('settings/account');
    });

    Route::get('settings/account', function () {
        return view('profile.settings');
    })->name('profile');

    Route::get('settings/schedules', EditSchedules::class)->name(
        'schedule-settings'
    );

    Route::get('assignments/assignment', function () {
        return abort(404);
    })->name('assignmentPage');

    Route::get('assignments/assignment/{assignment_string}', function (
        $assignmentString
    ) {
        return view('assignments.single', [
            'assignmentString' => $assignmentString,
        ]);
    })->middleware(['hasassignment:assignmentString']);

    Route::get('assignments/{class?}/{due?}', function (
        $class = -1,
        $due = 'Incomplete'
    ) {
        if ($class == 'all') {
            $class = -1;
        }
        if (
            $class == -1 ||
            Classes::where(['user_id' => Auth::id(), 'id' => $class])->exists()
        ) {
            if (ucfirst($due) != 'Incomplete' && ucfirst($due) != 'Completed') {
                abort(404);
            }
            return view('assignments.list', [
                'class' => $class,
                'due' => ucfirst($due),
            ]);
        } else {
            return redirect('/assignments');
        }
    })
        ->where(['name' => '[a-z]+'])
        ->name('assignments');

    Route::get('agenda', function () {
        return view('schedule')->with('initDate', Carbon::now());
    })->name('schedule');

    Route::middleware('verifyevent')
        ->get('agenda/invite/{event_id}/{user_id?}', function (
            Request $request,
            int $event_id,
            int $user_id = null
        ) {
            if (!$request->hasValidSignature()) {
                abort(401);
            }

            return view('schedule')->with(
                'sharedEvent',
                Event::with('creator')->find($event_id)
            );
        })
        ->name('share-event');

    Route::get('agenda/{month}/{day}/{year}/{view?}', function (
        $month,
        $day,
        $year,
        $view = null
    ) {
        $initDate = Carbon::now()
            ->setDay($day)
            ->setMonth($month)
            ->setYear($year);
        return view('schedule')->with([
            'initDate' => $initDate,
            'view' => $view,
        ]);
    });

    //Require password confirmation before accessing these routes
    Route::middleware(['haspassword', 'password.confirm'])->group(function () {
        Route::get(
            'settings/account/update-password',
            UpdatePassword::class
        )->name('account.update-password');
        Route::get('settings/account/two-factor', TwoFactorAuth::class)->name(
            'account.two-factor'
        );
        Route::get('settings/my-data', MyData::class)->name(
            'account.manage-data'
        );
    });

    Route::get('settings/account/manage-devices', LogoutOtherSessions::class)
        ->middleware('haspassword')
        ->name('account.manage-devices');
    Route::get('settings/account/set-password', UpdatePassword::class)
        ->middleware('haspassword:not')
        ->name('account.set-password');
    Route::get('settings/account/delete-account', DeleteAccount::class)
        ->middleware('haspassword')
        ->name('account.delete-account');
});

//AJAX Post Requests that require authentication (non API)

Route::middleware('auth')->group(function () {
    Route::post('event', [EventController::class, 'setColor']);

    Route::post('class/setschedule', [ClassController::class, 'setSchedule']);
    Route::post('class/addtime', [ClassController::class, 'addClassTime']);
    Route::post('class/removetime', [
        ClassController::class,
        'removeClassTime',
    ]);

    Route::post('event/invite/accept', [
        EventInviteController::class,
        'accept',
    ]);

    Route::post('event/invite/decline', [
        EventInviteController::class,
        'decline',
    ]);
});
