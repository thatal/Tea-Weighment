<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleware
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
        if(!Auth::guard($guard)->check() || auth()->user()->role !== "admin"){
            return redirect()->to(route("admin.login"))->with("error", "Access denied.");
        }
        return $next($request);
    }
}
