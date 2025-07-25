<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,int $role):Response
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect('/');
        } 
        elseif($user->usertype_id == $role)
        {
                return $next($request);
        }
        else
        {
            return redirect('/');
        }
    }
}
