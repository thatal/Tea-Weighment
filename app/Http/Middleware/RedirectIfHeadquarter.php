<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfHeadquarter
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
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->role === "headquarter") {
            return redirect("headquarter/dashboard");
        }
        return $next($request);
    }
}
