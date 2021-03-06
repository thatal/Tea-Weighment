<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfNotFactory
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
        if (!Auth::guard($guard)->check() || Auth::guard($guard)->user()->role != "factory") {
            return redirect("login")->with("error", "Access denied.");
        }
        return $next($request);
    }
}
