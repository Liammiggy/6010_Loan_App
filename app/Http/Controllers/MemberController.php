<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\MemberService;

class MemberController extends Controller
{
    protected MemberService $service;

    public function __construct(MemberService $service) {
        $this->service = $service;
    }

    public function index()
    {
        $members = $this->service->getMembers([]);
        return view('pages.members.index', compact('members'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->service->create($request->all());

        return back()->with('toast', ['type' => 'success', 'message' => 'Loan type created successfully']);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->service->update($request->all(), $id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Loan type updated successfully']);
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return back()->with('toast', ['type' => 'success', 'message' => 'Loan type deleted successfully']);
    }
}
