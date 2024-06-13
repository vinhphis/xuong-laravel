<?php

use App\Http\Controllers\Client\CartOrderController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PaymentMethodController;
use App\Http\Controllers\Client\SignInController;
use App\Http\Controllers\Client\SignUpController;
use App\Http\Controllers\Client\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('client')
    ->as('client.')
    ->group(function () {

        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::get('detail/{slug}', [HomeController::class, 'detail'])->name('productDetail');
        Route::get('list', [HomeController::class, 'list'])->name('productList');
        Route::get('list/{catelogue}', [HomeController::class, 'list'])->name('productListCatelogue');

        Route::prefix('user')
            ->as('user.')
            ->group(function () {
                Route::get('detail', [UserController::class, 'detail'])->name('detail');
                Route::get('voucher', [UserController::class, 'voucher'])->name('voucher');
                Route::post('voucher/add', [UserController::class, 'addVoucher'])->name('addVoucher');
            });

        Route::get('cart', [CartOrderController::class, 'showCart'])->name('cart');
        Route::post('cart', [CartOrderController::class, 'cart']);
        Route::get('cart/{id}', [CartOrderController::class, 'deleteCart'])->name('deleteCart');

//        Route::get('payment', [CartOrderController::class, 'showPayment']);
        Route::get('payment', [CartOrderController::class, 'showPayment'])->name('payment');
        Route::post('payment', [CartOrderController::class, 'payment']);

        Route::post('successPayment', [CartOrderController::class, 'successPayment'])->name('successPayment');

        Route::get('order', [CartOrderController::class, 'order'])->name('order');
        Route::get('orderItem/{id}', [CartOrderController::class, 'orderItem'])->name('orderItem');
        Route::get('order/canceled/{id}', [CartOrderController::class, 'orderCanceled'])->name('orderCanceled');


        Route::get('signIn', [SignInController::class, 'showSignIn'])->name('signIn');
        Route::post('signIn', [SignInController::class, 'signIn']);

        Route::get('logOut', [SignInController::class, 'logOut'])->name('logOut');

        Route::get('signUp', [SignUpController::class, 'showSignUp'])->name('signUp');
        Route::post('signUp', [SignUpController::class, 'signUp']);

        // thanh toán online
        Route::get('vnpay', [PaymentMethodController::class, 'vnpay_payment'])->name('vnpay_payment');

    });

Route::get('testInvoice', function () {
    $detailOrderUser = \App\Models\Orders::query()->first();
    return view('client.users.invoice', compact('detailOrderUser'));
});




