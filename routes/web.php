<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Contact\ContactForm;
use App\Http\Livewire\Profile\DeleteAccount;
use App\Http\Livewire\Profile\LogoutOtherSessions;
use App\Http\Livewire\Profile\MyData;
use App\Http\Livewire\Profile\TwoFactorAuth;
use App\Http\Livewire\Profile\UpdatePassword;
use App\Models\Classes;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
});

Route::middleware(['auth:sanctum', 'verified'])->get('/app', function () {
  return view('livewire.dashboard');
})->name('dashboard');

Route::get('login/google', [AuthController::class, 'redirectToGoogle']);

Route::get('login/callback/google', [AuthController::class, 'handleGoogleCallback']);

Route::match(['post'], 'login/callback/onetap', [AuthController::class, 'handleOneTapCallback']);

Route::get('login/set-password', function () {
  return view('auth.set-password');
})->name('set-password');

Route::get('login/confirm-password', function () {
  return view('auth.confirm-linking');
})->name('confirm-link');


Route::get('contact', ContactForm::class)->name('contact');

Route::get('user/theme', function () {
  return view('livewire.themes');
})->name('themes');

Route::middleware(['auth:sanctum', 'verified'])->get('user/schedule-settings', function () {
  return View::make('profile.schedule-settings');
})->name('schedule-settings');

Route::middleware(['auth:sanctum', 'verified'])->get('agenda', function () {
  return view('schedule')->with('initDate', Carbon::now());
})->name('schedule');

Route::middleware(['auth:sanctum', 'verified', 'verifyevent'])->get('agenda/invite/{id}/{user?}', function (Request $request, $id, $user = null) {
  if (!$request->hasValidSignature())
    abort(401);
  return view('schedule')->with('sharedEvent', Event::find($id));
})->name('share-event');

Route::middleware(['auth:sanctum', 'verified'])->get('agenda/{month}/{day}/{year}', function ($month, $day, $year) {
  $initDate = Carbon::now();
  $initDate->setDay($day)->setMonth($month)->setYear($year);
  return view('schedule')->with('initDate', $initDate);
});

Route::middleware(['auth:sanctum', 'verified'])->get('user/profile', function () {
  return View::make('profile.show');
})->name('profile');

Route::get('logout', function () {
  return redirect()->intended('login');
});

Route::get('offline', function () {
  return view('offline');
});

Route::get('register', Register::class)->name('register');

Route::get('privacy-policy', function () {
  return view('privacy-policy');
})->name('privacy-policy');

Route::get('assignments/assignment/{assignment_string}', function ($assignmentString) {
  return view('assignments.assignment-page', ['assignmentString' => $assignmentString]);
})->middleware(['auth:sanctum', 'verified', 'hasassignment:assignmentString']);

Route::middleware(['auth:sanctum', 'verified'])->get('assignments/{class?}/{due?}', function ($class = -1, $due = 'Incomplete') {
  if ($class == 'all')
    $class = -1;
  if ($class == -1 || Classes::where(['userid' => Auth::User()->id, 'id' => $class])->exists()) {
    if (ucfirst($due) != 'Incomplete' && ucfirst($due) != 'Completed')
      abort(404);
    return view('assignments.assignment-list', ['class' => $class, 'due' => ucfirst($due)]);
  } else
    return redirect('/assignments');
})->where(['name' => '[a-z]+'])->name('assignments');

Route::get('assignments/assignment', function () {
  return abort(404);
})->middleware(['auth:sanctum', 'verified'])->name('assignmentPage');

Route::get('user/account', function () {
  return view('profile.settings');
})->middleware(['auth:sanctum', 'verified'])->name('profile');

Route::get('user/profile', function () {
  return redirect('user/account');
})->middleware(['auth:sanctum', 'verified']);

Route::get('account', function () {
  return redirect('user/account');
})->middleware(['auth:sanctum', 'verified']);


Route::middleware(['auth:sanctum', 'verified', 'haspassword', 'password.confirm'])->group(function () {
  Route::get('user/account/update-password', UpdatePassword::class)->name('account.update-password');
  Route::get('user/account/two-factor', TwoFactorAuth::class)->name('account.two-factor');
  Route::get('user/my-data', MyData::class)->name('account.manage-data');
});

Route::get('user/account/manage-devices', LogoutOtherSessions::class)->middleware(['auth:sanctum', 'verified', 'haspassword'])->name('account.manage-devices');
Route::get('user/account/set-password', UpdatePassword::class)->middleware(['auth:sanctum', 'verified', 'haspassword:not'])->name('account.set-password');
Route::get('user/account/delete-account', DeleteAccount::class)->middleware(['auth:sanctum', 'verified', 'haspassword'])->name('account.delete-account');

Route::get('forgot-password', function () {
  return view('auth.forgot-password');
})->name('password.request');
