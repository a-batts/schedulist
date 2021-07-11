<?php

namespace App\Http\Controllers\Auth;

use Exception;

use App\Http\Controllers\Controller;

use App\Models\User;

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
              return redirect()->to('/app');
          }
          catch (Exception $e) {
              return 'error';
          }

        }
    }
}
