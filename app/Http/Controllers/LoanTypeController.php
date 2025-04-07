<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    public function index()
    {
        return view('pages.loan-types.index');
    }
}
