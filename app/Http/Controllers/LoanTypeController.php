<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\LoanTypeService;

class LoanTypeController extends Controller
{

    protected LoanTypeService $service;

    public function __construct(LoanTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $loanTypes = $this->service->getLoanTypes([]);
        return view('pages.loan-types.index', compact('loanTypes'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'interest_rate' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->service->create($request->all());
        session()->flash('toast', ['type' => 'success', 'message' => 'Loan type created successfully']);
        return response()->json([], 200);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'interest_rate' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->service->update($request->all(), $id);
        session()->flash('toast', ['type' => 'success', 'message' => 'Loan type updated successfully']);
        return response()->json([], 200);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        session()->flash('toast', ['type' => 'success', 'message' => 'Loan type deleted successfully']);
        return response()->json([], 200);
    }
    

}
