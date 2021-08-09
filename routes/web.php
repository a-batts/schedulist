<?php

use App\Http\Controllers\Auth\AuthController;

use App\Models\Event;
use App\Models\Classes;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Contact\ContactForm;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/app', function () {
    return view('livewire.dashboard');
})->name('dashboard');

Route::get('login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('googleCallback');;

Route::get('contact', ContactForm::class)->name('contact');

Route::get('user/theme', function () {
  return view('livewire.themes');
})->name('themes');

Route::middleware(['auth:sanctum', 'verified'])->get('user/schedule-settings', function() {
  return View::make('profile.schedule-settings');
})->name('schedule-settings');

Route::middleware(['auth:sanctum', 'verified'])->get('agenda', function() {
  return view('schedule')->with('initDate', Carbon::now());
})->name('schedule');

Route::middleware(['auth:sanctum', 'verified', 'verifyevent'])->get('agenda/invite/{id}/{user?}', function(Request $request, $id, $user = null) {
  if (! $request->hasValidSignature())
    abort(401);
  return view('schedule')->with('sharedEvent', Event::find($id));
})->name('share-event');

Route::middleware(['auth:sanctum', 'verified'])->get('agenda/{month}/{day}/{year}', function($month, $day, $year) {
  $initDate = Carbon::now();
  $initDate->setDay($day)->setMonth($month)->setYear($year);
  return view('schedule')->with('initDate', $initDate);
});

Route::middleware(['auth:sanctum', 'verified'])->get('user/profile', function() {
    return View::make('profile.show');
})->name('profile');

Route::get('logout', function(){
  return redirect()->intended('login');
});

Route::get('offline', function(){
  return view('offline');
});

Route::get('register', Register::class)->name('register');

Route::get('privacy-policy', function () {
  return view('privacy-policy');
})->name('privacy-policy');

Route::get('assignments/assignment/{assignment_string}', function($assignmentString){
  return view('assignments.assignment-page', ['assignmentString' => $assignmentString]);
})->middleware(['auth:sanctum', 'verified', 'hasassignment:assignmentString']);

Route::middleware(['auth:sanctum', 'verified'])->get('assignments/{class?}/{due?}', function ($class = -1, $due = 'Incomplete'){
  if($class == 'all')
    $class = -1;
  if($class == -1 || Classes::where(['userid' => Auth::User()->id, 'id' => $class])->exists()){
    if (ucfirst($due) != 'Incomplete' && ucfirst($due) != 'Completed')
      abort(404);
    return view('assignments.assignment-list', ['class' => $class, 'due' => ucfirst($due)]);
  }
  else
    return redirect('/assignments');
})->where(['name' => '[a-z]+'])->name('assignments');

Route::get('assignments/assignment', function(){
  return abort(404);
})->name('assignmentPage');
