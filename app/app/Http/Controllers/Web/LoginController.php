<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\UserActivity;

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
    protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function loginForm(){
        return view('auth.web_login');
    }

    
    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login' => Carbon::now()->toDateTimeString(),
            'login_ip'  => $request->getClientIp(),
        ]);
        UserActivity::create([
            'user_id' => $user->id,
            'last_login' => Carbon::now()->toDateTimeString(),
            'login_ip' => $request->Ip(),
        ]);
    }
}
