<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($auth)
    {
      if($auth =="google"){
        return Socialite::driver('google')->redirect();
      }
      elseif ($auth =="facebook") {
        return Socialite::driver('facebook')->redirect();
      }
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($auth)
    {
      try{
        $user = Socialite::driver($auth)->stateless()->user();
        if(!$user->getEmail() && $auth =="facebook"){
          return "<center><h1 style='margin-top:20%'>Sorry, could not sign in with facebook <br/> <a href='/'>Try something else</a></center>"; 
        }
          $foundUser = User::where('email',$user->getEmail())->first(); 
          if($foundUser){
            Auth::login($foundUser);
          }
          else{
            $newUser = new User(); 
            $newUser->name = $user->getName(); 
            $newUser->email = $user->getEmail(); 
            $newUser->password = bcrypt('100kLegacy'.$user->getEmail().'@2020'); 
            $newUser->save();
            Auth::login($newUser);
          }
          return redirect('/');
      }
      catch(\Exception $e){
        return "<center><h1 style='margin-top:20%'>Sorry, could not sign in with $auth <br/> <a href='/'>Try something else</a></center>";
      }
    }
}
