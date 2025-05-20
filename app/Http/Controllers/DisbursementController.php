<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DisbursementService;

class DisbursementController extends Controller
{
    protected DisbursementService $service;

    public function __construct(DisbursementService $service)
    {
        $this->service = $service;
    }
    //
    public function index(Request $request)
    {
        if(!auth()->user()->hasPermission('loan_disburse'))
        {
            return redirect()->route('dashboard')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to access this page']);
        }
        $type = 'New';
        $loanApplications = $this->service->getApprovedLoans();
        return view('pages.disbursements.index', compact('type', 'loanApplications'));
    }

    public function edit(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('loan_status'))
        {
            return redirect()->route('dashboard')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to access this page']);
        }
        $type = 'Edit';
        $loanApplications = $this->service->getLoans($id);
        $disbursement = $this->service->getDisbursement($id);
        return view('pages.disbursements.index', compact('type', 'loanApplications', 'id', 'disbursement'));
    }

    public function store(Request $request)
    {
        $this->service->store($request->all());
        session()->flash('toast', ['type' => 'success', 'message' => 'Disbursement created successfully']);
        return response()->json([], 200);
    }

    public function update(Request $request, $id)
    {
        $this->service->update($request->all(), $id);
        session()->flash('toast', ['type' => 'success', 'message' => 'Disbursement updated successfully']);
        return response()->json([], 200);
    }
}
