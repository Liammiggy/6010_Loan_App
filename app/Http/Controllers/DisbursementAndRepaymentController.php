<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisbursementAndRepaymentController extends Controller
{
    public function index()
    {
        return view('pages.disbursements-and-repayments.index');
    }
}
