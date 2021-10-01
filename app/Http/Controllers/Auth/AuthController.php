<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Google_Client;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return Socialite
   */
  public function redirectToGoogle() {
    return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
  }

  /**
   * Create a new controller instance.
   *
   * @return \Illuminate\Routing\Redirector|string
   */
  public function handleGoogleCallback() {
    if (Auth::check()) {
      try {
        $user = Auth::user();
        $newUser = Socialite::driver('google')->user();
        $existUser = User::where('google_email', $newUser->email)->first();
        if ($existUser) {
          return redirect('user/profile');
        } else {
          $user->google_email = $newUser->email;
          $user->google_id = $newUser->id;
          $user->save();
          return redirect('user/profile');
        }
      } catch (Exception $e) {
        return 'error';
      }
    } else {
      try {
        $socialite = Socialite::driver('google')->user();

        $data = $socialite->user;

        $existingUser = User::where('email', $socialite->getEmail())->first();
        if (User::where('google_email', $socialite->getEmail())->exists()) {
          $gUser = User::where('google_email', $socialite->getEmail())->first();
          Auth::loginUsingId($gUser->id);
          return redirect()->to('/app');
        }
        if ($existingUser != null && $existingUser->google_id != null && $existingUser->google_id != 0) {
          Auth::loginUsingId($existingUser->id);
          return redirect()->to('/app');
        } else if ($existingUser != null) {
          return redirect()->route('confirm-link')->with('data', (array) $data);
        } else {
          return redirect('/login/set-password')->with('data', (array) $data);
        }
      } catch (Exception $e) {
        return 'error';
      }
    }
  }

  public function handleOneTapCallback() {
    $token = $_POST["credential"];
    $client = new Google_Client(['client_id' => '827540481261-uhs04f4uecph0vpigh7tcek6jdfp7ggl.apps.googleusercontent.com']);
    $payload = $client->verifyIdToken($token);
    if (!$payload)
      return redirect()->to('/');

    $data = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))));

    $existingUser = User::where('email', $data->email)->first();
    if (User::where('google_email', $data->email)->exists()) {
      $gUser = User::where('google_email', $data->email)->first();
      Auth::loginUsingId($gUser->id);
      return redirect()->to('/app');
    }
    if ($existingUser != null && $existingUser->google_id != null && $existingUser->google_id != 0) {
      Auth::loginUsingId($existingUser->id);
      return redirect()->to('/app');
    } else if ($existingUser != null) {
      return redirect()->route('confirm-link')->with('data', (array) $data);
    } else {
      return redirect('/login/set-password')->with('data', (array) $data);
    }
  }
}
