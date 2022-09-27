<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Referral
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('ref')) {
            session()->put('ref', $request->input('ref'));
        }

        return $next($request);
    }
}
