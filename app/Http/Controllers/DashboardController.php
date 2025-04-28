<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DashboardService;
class DashboardController extends Controller
{
    protected DashboardService $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }   
    public function index()
    {
        $activeLoans = $this->service->activeLoans();
        $pendingApplications = $this->service->countPendingApplications();
        $overDuePayments = $this->service->overDuePayments();
        $upcomingPayments = $this->service->upcomingPayments();
        $recentLoanApplications = $this->service->recentLoanApplications();
        $loanDistributionByType = $this->service->loanDistributionByType();
        $totalLoans = $this->service->totalLoans();
        $loanTypes = $this->service->getLoanTypes();
        return view('pages.dashboard.index', 
        compact(
            'activeLoans', 
            'pendingApplications', 
            'overDuePayments', 
            'upcomingPayments',
            'recentLoanApplications',
            'loanDistributionByType',
            'loanTypes',
            'totalLoans'
        ));
    }
}
