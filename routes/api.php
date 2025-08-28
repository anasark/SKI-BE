<?php

use App\Http\Controllers\Api\ChartOfAccountController;
use App\Http\Controllers\Api\ClosingPeriodController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\JournalLineController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TrialBalanceController;
use Illuminate\Support\Facades\Route;

Route::apiResource('chart-of-accounts', ChartOfAccountController::class);
Route::apiResource('journals', JournalController::class);
Route::apiResource('journal-lines', JournalLineController::class);
Route::apiResource('invoices', InvoiceController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('closing-periods', ClosingPeriodController::class);

Route::get('/trial-balance', [TrialBalanceController::class, 'index']);
Route::get('/trial-balance/pdf', [TrialBalanceController::class, 'pdf']);
