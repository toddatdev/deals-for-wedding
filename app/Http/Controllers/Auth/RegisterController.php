<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'fname'    => $data['fname'],
            'lname'    => isset($data['lname']) ? $data['lname'] : null,
            'email'    => $data['email'],
            'role'     => '2',//user=2;admin=1
            'status'     => '1',//active=1;inactive=0
            'password' => Hash::make($data['password']),
        ]);

        $userDetails = UserDetails::create([
                        'phone' => isset($data['phone']) ? $data['phone'] : null,
                        'wedding_date' => isset($data['wedding_date']) ? $data['wedding_date'] : null,
                        'city' => isset($data['city']) ? $data['city'] : null,
                        'state' => isset($data['state']) ? $data['state'] : null,
                        'zip' => isset($data['zip']) ? $data['zip'] : null,
                        'user_id' => $user->id,
                      ]);
        $advertiser = $user->id;
        NotificationController::user_registration_notify($advertiser);
        Session::flash('success', 'You have successfully registered with us. Login to continue..'); 
        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        // $this->guard()->login($user);
        return $this->registered($request, $user)
                            ?: redirect($this->redirectPath());
     }
}
