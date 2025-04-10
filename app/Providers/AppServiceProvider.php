<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\LoanAppObserver;

use App\Models\{Role, User, LoanType};

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
        Role::observe(LoanAppObserver::class);
        User::observe(LoanAppObserver::class);
        LoanType::observe(LoanAppObserver::class);
    }
}
