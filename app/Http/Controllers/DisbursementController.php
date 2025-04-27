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
        $type = 'New';
        $loanApplications = $this->service->getApprovedLoans();
        return view('pages.disbursements.index', compact('type', 'loanApplications'));
    }

    public function edit(Request $request, $id)
    {
        $type = 'Edit';
        $loanApplications = $this->service->getLoans($id);
        $disbursement = $this->service->getDisbursement($id);
        return view('pages.disbursements.index', compact('type', 'loanApplications', 'id', 'disbursement'));
    }

    public function store(Request $request)
    {
        $this->service->store($request->all());
        return response()->json([], 200);
    }

    public function update(Request $request, $id)
    {
        $this->service->update($request->all(), $id);
        return response()->json([], 200);
    }
}
