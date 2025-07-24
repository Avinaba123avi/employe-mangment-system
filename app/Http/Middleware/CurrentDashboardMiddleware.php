<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Session;

class CurrentDashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //$allowedRoutes = ['forpass', 'recode', 'newpass'];

        if (Auth::check()) {
            $currentRoute = $request->route()->getName(); 
            if (in_array($currentRoute, ['login','regi','admin.dashboard', 'manager.dashboard', 'employee.dashboard','forpass','recode','newpass'])) {
                $previousRoute = Session::get('previous_route', null);
                if ($previousRoute) {
                    return redirect()->to($previousRoute); 
                } 
                else 
                {
                    $user = Auth::user(); 

                        if ($user->usertype_id == 1) {
                            return redirect()->route('admin.dashboard');
                        } elseif ($user->usertype_id == 2) {
                            return redirect()->route('manager.dashboard');
                        } else {
                        
                            return redirect()->route('employee.dashboard');
                        } 
                }
            }
            Session::put('previous_route', $currentRoute);
        }

        return $next($request); 


        // $allowedRoutes = ['forpass', 'recode', 'newpass'];

        // if (Auth::check()) {
        //     $currentRoute = $request->route()->getName(); 

        //     if (in_array($currentRoute, ['login', 'regi'])) {
        //         return $next($request);
        //     }

        //     if (!in_array($currentRoute, $allowedRoutes)) {
        //         $user = Auth::user(); 

        //         if ($user->usertype_id == 1) {
        //             return redirect()->route('admin.dashboard');
        //         } elseif ($user->usertype_id == 2) {
        //             return redirect()->route('manager.dashboard');
        //         } else {
        //             return redirect()->route('employee.dashboard');
        //         }
        //     }
        // }

        // return $next($request); 
    }
}
