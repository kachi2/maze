<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckRegistrationComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (empty($user->username) || empty($user->name)) {
                if (Route::currentRouteName() != 'complete_registration' && Route::currentRouteName() != 'logout') {
                    return redirect()->route('complete_registration');
                }
            } elseif (Route::currentRouteName() == 'complete_registration') {
                return redirect()->route('account');
            }
        }
        return $next($request);
    }
}
