<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/stripe/portal', [StripeController::class, 'portal'])->name('stripe.portal');
});

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/billing', [BillingController::class, 'index'])->name('billing');
    Route::get('/billing/cancel', [BillingController::class, 'cancel'])->name('billing.cancel');
    Route::get('/billing/resume', [BillingController::class, 'resume'])->name('billing.resume');
});
