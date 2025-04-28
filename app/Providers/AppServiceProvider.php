<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\LoanAppObserver;

use App\Models\{Role, User, LoanType, Member, LoanApplication, Permission, Disbursement, Repayment};

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
        Member::observe(LoanAppObserver::class);
        LoanApplication::observe(LoanAppObserver::class);
        Permission::observe(LoanAppObserver::class);
        Disbursement::observe(LoanAppObserver::class);
        Repayment::observe(LoanAppObserver::class);
    }
}
