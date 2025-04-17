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
Route::get('/payments-and-transactions', [PaymentAndTransactionController::class, 'index'])->name('payments-and-transactions');

Route::post('/logout', function () { return "logout"; })->name('logout');
Route::get('/loan-calculator', [LoanCalculatorController::class, 'index'])->name('loan-calculator.index');

Route::controller(UserManagementController::class)->group(function () {
    Route::get('/user-management', 'index')->name('user-management');
    Route::get('/user-management/roles', 'roles')->name('user-management.roles');
    Route::post('/user-management/roles', 'storeRole')->name('user-management.roles.store');
    Route::post('/user-management/roles/{id}', 'updateRole')->name('user-management.roles.update');
    Route::post('/user-management/roles/delete/{id}', 'deleteRole')->name('user-management.roles.delete');
    Route::get('/user-management/users', 'users')->name('user-management.users');
    Route::post('/user-management/users', 'storeUser')->name('user-management.users.store');
    Route::post('/user-management/users/{id}', 'updateUser')->name('user-management.users.update');
    Route::post('/user-management/users/delete/{id}', 'deleteUser')->name('user-management.users.delete');
});

Route::controller(LoanTypeController::class)->group(function () {
    Route::get('/loan-types', 'index')->name('loan-types');
    Route::post('/loan-types', 'store')->name('loan-types.store');
    Route::post('/loan-types/{id}', 'update')->name('loan-types.update');
    Route::post('/loan-types/delete/{id}', 'destroy')->name('loan-types.destroy');
});

Route::controller(MemberController::class)->group(function () {
    Route::get('/members', 'index')->name('members');
    Route::post('/members', 'store')->name('members.store');
    Route::post('/members/{id}', 'update')->name('members.update');
    Route::post('/members/delete/{id}', 'destroy')->name('members.destroy');
}) ;
