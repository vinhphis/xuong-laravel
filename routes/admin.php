<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BannerMktController;
use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('auth/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('auth/register', [RegisterController::class, 'register']);

Route::prefix('admin')
    ->middleware(['auth', 'isAdmin']) // check quyền
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');



        Route::resource('catelogues', CatelogueController::class);

        Route::resource('products', ProductController::class);

        Route::resource('vouchers', VoucherController::class);

        Route::resource('users', UserController::class);

        Route::resource('bannerMkts', BannerMktController::class);

        Route::prefix('order')
            ->as('orders.')
            ->group(function () {
                Route::get('list', [OrderController::class, 'list'])->name('list');
                Route::get('detail/{id}', [OrderController::class, 'detail'])->name('detail');
                Route::get('invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');
                Route::post('detail/statusOrder', [OrderController::class, 'updateStatusOrder'])->name('updateStatusOrder');
                Route::post('detail/statusPayment', [OrderController::class, 'updateStatusPayment'])->name('updateStatusPayment');

                Route::post('destroy/{orders}', [OrderController::class, 'destroy'])->name('destroy');
            });
    });




