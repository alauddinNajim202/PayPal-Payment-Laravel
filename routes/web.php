<?php

use App\Http\Controllers\PaypalPaymentController;
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


// paypal

Route::get('/paypal', [PaypalPaymentController::class, 'index'])->name('paypal.index');
Route::get('paypal/payment', [PaypalPaymentController::class, 'createPayment'])->name('paypal.payment');

Route::get('paypal/payment/success', [PaypalPaymentController::class, 'paymentSuccess'])->name('paypal.payment.success');

Route::get('paypal/payment/cancel', [PaypalPaymentController::class, 'paymentCancel'])->name('paypal.payment.cancel');