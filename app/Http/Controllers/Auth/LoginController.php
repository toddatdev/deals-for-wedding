<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = '/deals';

    protected function redirectTo()
    {
        if (auth()->user()->role == 1) {
            return redirect()->route('deals.index');
        }
        elseif (auth()->user()->role == 2){
           if (is_null(\Auth::user()->last_login_at)){

               \Auth::user()->update([
                   'last_login_at' => now()
               ]);

               return '/welcome';
           }else{

               \Auth::user()->update([
                   'last_login_at' => now()
               ]);

               return '/welcome';
           }
        }
        elseif (auth()->user()->role == 3){
            return redirect()->route('vendor.deals.index');
        }
        else{
            return '/';
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('front.oh-hey-there');
    }
}
