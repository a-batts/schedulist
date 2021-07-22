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

Route::middleware(['auth:sanctum', 'verified'])->get('assignments/all/late', function(){
  return view('assignments.assignment', ['period' => null, 'due' => 'late']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('assignments/all/done', function(){
  return view('assignments.assignment', ['period' => null, 'due' => 'done']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('assignments/all', function(){
  return redirect('assignments')->with(['period' => null, 'due' => null]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('assignments/{period?}/{due?}', function ($period = null, $due = null){
  if ($due == 'late' || $due == 'done' || $due == null){
    if($period == null || Classes::where(['userid' => Auth::user()->id, 'period' => $period])->exists())
      return view('assignments.assignment', ['period' => $period, 'due' => $due]);
    return redirect('assignments')->with(['period' => null, 'due' => null]);
  }
  else
    return redirect('assignments/'.$period)->with(['period' => $period, 'due' => null]);
})->where(['period' => '[1-8]+', 'name' => '[a-z]+'])->name('assignments');


Route::get('assignments/assignment/{assignment_string}', function($assignment_string){
  return view('assignments.assignment-page', ['assignment_string' => $assignment_string]);
})->middleware(['auth:sanctum', 'verified', 'hasassignment:assignment_string']);

Route::get('assignments/assignment', function(){
  return abort(404);
})->name('assignmentPage');
