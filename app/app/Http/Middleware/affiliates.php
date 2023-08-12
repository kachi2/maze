<?php

namespace App\Http\Middleware;

use Closure;

class affiliates
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
       // dd(auth('affiliates')->user());
        if(auth()->guard('affiliates')){
          if()
        }
        return $next($request);
    }
}
