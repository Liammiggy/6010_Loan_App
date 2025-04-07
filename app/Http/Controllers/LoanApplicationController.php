<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    public function index()
    {
        return view('pages.loan-applications.index');
    }
}
