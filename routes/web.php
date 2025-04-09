<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisbursementAndRepaymentController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanCalculatorController;
use App\Http\Controllers\LoanTypeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentAndTransactionController;
use App\Http\Controllers\UserManagementController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/disbursements-and-repayments', [DisbursementAndRepaymentController::class, 'index'])->name('disbursements-and-repayments');
Route::get('/loan-applications', [LoanApplicationController::class, 'index'])->name('loan-applications');
Route::get('/loan-types', [LoanTypeController::class, 'index'])->name('loan-types');
Route::get('/members', [MemberController::class, 'index'])->name('members');
Route::get('/payments-and-transactions', [PaymentAndTransactionController::class, 'index'])->name('payments-and-transactions');
Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/loan-calculator', [LoanCalculatorController::class, 'index'])->name('loan-calculator.index');

// Route::get('/', function () {
//     return redirect()->route('login');
// });
