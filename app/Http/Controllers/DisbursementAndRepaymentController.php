<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DisbursementService;

class DisbursementAndRepaymentController extends Controller
{
    protected DisbursementService $service;

    public function __construct(DisbursementService $service) {
        $this->service = $service;
    }

    public function index()
    {
        if(!auth()->user()->hasPermission('loan_disburse') && !auth()->user()->hasPermission('repayment_schedule'))
        {
            return redirect()->route('dashboard')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to access this page']);
        }
        $disbursements = $this->service->getDisbursements([]);
        $loanApplications = $this->service->getApprovedLoans();
        $repayments = $this->service->getRepayments([]);
        return view('pages.disbursements-and-repayments.index', compact('disbursements', 'loanApplications', 'repayments'));
    }
}
