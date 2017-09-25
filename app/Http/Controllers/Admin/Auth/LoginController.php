<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;
use Validator;
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

    protected $guard = 'admin';
    protected $loginView = 'admin.auth.login';
    protected $registerView = 'admin.auth.register';
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:admins',
            'password' =>'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Admin::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

















}
