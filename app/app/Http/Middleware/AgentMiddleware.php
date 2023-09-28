<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AgentMiddleware
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
 
        if(auth::guard('agent')->check()){
            if(!auth::guard('agent')){
                return redirect()->route('affiliates.loginform');
            }
        }
        return $next($request);
    }
}
