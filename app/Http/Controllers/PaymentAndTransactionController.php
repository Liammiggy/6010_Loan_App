<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentAndTransactionController extends Controller
{
    public function index()
    {
        return view('pages.payments-and-transactions.index');
    }
}
