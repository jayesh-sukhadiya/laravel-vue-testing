<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
Use Validator;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function login(Request $request)
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required' 
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput($request->password); // send back the input (not the password) so that we can repopulate the form
        } else {
            // create our user data for the authentication
            if(is_numeric($request->get('username'))){ // mobile number login
                $userdata = array(
                'password'  => $request->password,
                'use_mob_no'=> $request->username,
                );
            }else{
                $userdata = array(
                    'password'=> $request->password,
                    'email'=> $request->username,
                );
            }   
            // attempt to do the login
            if (Auth::attempt($userdata,true)) {
                return redirect('/dashboard');
            } else {
                Session::flash('error', "Username and password doesn't match!");
                return redirect('login');
            }
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function forgotPassword()
    {
       return view('auth.forgot-password');
    }
}
