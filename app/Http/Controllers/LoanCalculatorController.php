<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanCalculatorController extends Controller
{
    public function index()
    {
        return view('pages.loan-calculator.index');
    }
}
