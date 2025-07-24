<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\registeruser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define Gates for user roles
        Gate::define('admin', function (registeruser $user) {
            return $user->hasRole('admin');
        });

        Gate::define('manager', function (registeruser $user) {
            return $user->hasRole('manager');
        });

        Gate::define('employee', function (registeruser $user) {
            return $user->hasRole('employee');
        });
        Paginator::useBootstrapFive();
    }
}
