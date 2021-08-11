<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Google_Client;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
      if(Auth::check()){
        try {
          $user = Auth::user();
          $newUser = Socialite::driver('google')->user();
          $existUser = User::where('google_email',$newUser->email)->first();
          if($existUser) {
            return redirect('user/profile');
          }
          else{
            $user->google_email = $newUser->email;
            $user->google_id = $newUser->id;
            $user->save();
            return redirect('user/profile');
          }

        }
        catch (Exception $e) {
            return 'error';
        }
      } else {
          try {


              $newUser = Socialite::driver('google')->user();
              $googleExistUser = User::where('google_email',$newUser->email)->first();
              $existUser = User::where('email',$newUser->email)->first();


              if($googleExistUser) {
                  $googleExistUser->google_id = $newUser->id;
                  $googleExistUser->save();
                  Auth::loginUsingId($googleExistUser->id);
              }
              elseif($existUser) {
                  if ($existUser->google_id != 0){
                    $existUser->google_id = $newUser->id;
                    $existUser->save();
                    Auth::loginUsingId($existUser->id);
                  }
                  else{
                    return redirect('login')->withErrors([
                          'email' => ['Sign in with your email and password to enable Google sign in.']
                    ]);
                  }
              }
              else {
                  $user = new User;
                  $toSplit = $newUser->name;
                  $splitName = explode(' ', $toSplit, 2);
                  $user->firstname = $splitName[0];
                  $user->lastname = $splitName[1];
                  $user->email = $newUser->email;
                  $user->google_email = $newUser->email;
                  $user->google_id = $newUser->id;
                  $user->password = null;
                  $user->save();
                  Auth::loginUsingId($user->id);
              }
              return redirect()->intended(route('dashboard'));
          }
          catch (Exception $e) {
              return 'error';
          }

        }
    }

    public function handleOneTapCallback(){
      $token = $_POST["credential"];
      $client = new Google_Client(['client_id' => '827540481261-uhs04f4uecph0vpigh7tcek6jdfp7ggl.apps.googleusercontent.com']);
      $payload = $client->verifyIdToken($token);
      if (! $payload)
        return redirect()->to('/');

      $data = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));

      $existingUser = User::where('email', $data->email)->first();
      if (User::where('google_email', $data->email)->exists()){
        $gUser = User::where('google_email', $data->email)->first();
        Auth::loginUsingId($gUser->id);
        return redirect()->to('/app');
      }
      if ($existingUser != null && $existingUser->google_id != null && $existingUser->google_id != 0){
        Auth::loginUsingId($existingUser->id);
        return redirect()->to('/app');
      }
      else if ($existingUser != null){
        return redirect()->route('confirm-link')->with('data', (array) $data);
      }
      else {
        return redirect('/login/set-password')->with('data', (array) $data);
      }
    }
}
