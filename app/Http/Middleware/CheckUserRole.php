<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, int $role)
    {
        if (Auth::check() && Auth::user()->usertype_id == $role) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Access denied.');

    }
}
