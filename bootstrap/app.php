<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\MiddleWare\Authenticate;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\CurrentDashboardMiddleware;
use App\Http\Middleware\CurrentDashboardMiddlewareManger;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\EnsureGuestOrAuthenticated;
use App\Http\Middleware\ManagerMiddleware;
use App\Http\MiddleWare\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\UserMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware-> alias([
           'admin' =>  AdminMiddleware::class,
            'manager' =>ManagerMiddleware::class,
            'employee' => EmployeeMiddleware::class,
            'currentDashboard' => CurrentDashboardMiddleware::class,
            'checkPermission' => CheckPermission::class,
            //'checkPassword' => EnsureGuestOrAuthenticated::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
