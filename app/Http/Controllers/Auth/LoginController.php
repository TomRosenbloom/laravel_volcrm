<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Session;

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

    /**
     * overide authenticated method to insert flash message
     *
     * @param  Request $request [description]
     * @param  [type]  $user    [description]
     * @return [type]           [description]
     */
    protected function authenticated(Request $request, $user)
    {
        $request->session()->flash('success', $user->name . ' logged in');
    }

    /**
     * overide logout method to insert flash message
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->flash('success', 'You have logged out');
        return redirect($this->redirectTo);
    }
}
