<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Repayment;

class RepaymentsController extends Controller
{
    public function update(Request $request, $id) {
        $request->validate([
            'amount' => 'required|numeric',
            'repayment_date' => 'required|date',
        ]);

        $data = (array) $request->only(['amount', 'repayment_date','repayment_method', 'collector','notes']);
        $data['status'] = 'paid';
        \DB::beginTransaction();
        $repayment = Repayment::findOrFail($id);
        $repayment->update($data);
        \DB::commit();
        session()->flash('toast', ['type' => 'success', 'message' => 'Repayment updated successfully']);
        return response()->json([], 200);
    }
}
