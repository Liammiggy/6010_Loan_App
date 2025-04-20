<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\LoanApplicationService;

class LoanApplicationController extends Controller
{
    protected LoanApplicationService $service;

    public function __construct(LoanApplicationService $service) {
        $this->service = $service;
    }

    public function index()
    {
        $loanApplications = $this->service->getLoanApplications([]);
        $members = $this->service->getMembers();
        $loanTypes = $this->service->getLoanTypes();
        
        return view('pages.loan-applications.index',compact('members','loanTypes','loanApplications'));
    }

    public function new()
    {
        $type = 'New';
        $members = $this->service->getMembers();
        $loanTypes = $this->service->getLoanTypes();
        
        return view('pages.loan-applications.partials.loan-app',compact('members','loanTypes', 'type'));
    }

    public function view($id)
    {
        $type = 'View';
        $loanApplication = $this->service->getLoanApplication(['id' => $id]);
        $members = $this->service->getMembers();
        $loanTypes = $this->service->getLoanTypes();
        
        return view('pages.loan-applications.partials.loan-app',compact('loanApplication', 'members', 'loanTypes', 'type'));
    }

    public function store(Request $request) {
        
        if($request->member == "new") {
            $validator = Validator::make($request->all(), [
                "amount" => "required|numeric",
                "loan_type_id" => "required|numeric",
                "interest_rate" => "required|numeric",
                "term" => "required|numeric",
                "frequency" => "required|string",
                'name' => 'required|string|max:255',
                'email' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string'
            ]);
        } else {
             $validator = Validator::make($request->all(), [
                "amount" => "required|numeric",
                "loan_type_id" => "required|numeric",
                "interest_rate" => "required|numeric",
                "term" => "required|numeric",
                "frequency" => "required|string"
            ]);
        }
        
        if ($validator->fails()) {
            return back()->with($validator->errors());
        }

        if($request->member == "new") {
            $this->service->create($request->all(), $this->service->newMember($request->all())->id);
        } else {
            $this->service->create($request->all(), $request->member);
        }
        
        return redirect(route('loan-applications'))->with('toast', ['type' => 'success', 'message' => 'Loan Application created successfully']);

    }

    public function update(Request $request, $id) {

         $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'remarks' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->service->update($request->all(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Loan Application has been ' . $request->status . ' successfully']);

    }
}
