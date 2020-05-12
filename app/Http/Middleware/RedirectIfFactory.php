<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfFactory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->role === "factory") {
            return redirect("factory/dashboard");
        }
        return $next($request);
    }
}
