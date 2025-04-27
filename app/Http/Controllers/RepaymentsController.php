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

        $repayment = Repayment::findOrFail($id);
        $repayment->update(['status' => 'paid']);

        return redirect()->route('disbursements-and-repayments.index')->with('success', 'Repayment updated successfully.');
    }
}
