<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class EnsureGuestOrAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoutes = ['forpass', 'recode', 'newpass', 'login', 'register'];

        if (Auth::check()) {
            $currentRoute = $request->route()->getName();

            if (!in_array($currentRoute, $allowedRoutes)) {
                $user = Auth::user();

                if ($user->usertype_id == 1) {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->usertype_id == 2) {
                    return redirect()->route('manager.dashboard');
                } else {
                    return redirect()->route('employee.dashboard');
                }
            }
        } else {
            $currentRoute = $request->route()->getName();
            if (!in_array($currentRoute, $allowedRoutes)) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
