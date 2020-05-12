<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfAadmin
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
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->role === "admin") {
            return redirect("admin/dashboard");
        }
        return $next($request);
    }
}
