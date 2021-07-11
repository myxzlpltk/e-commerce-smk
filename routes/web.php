<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'welcome'])->name('home');

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('can:isBuyerOrGuest')->group(function (){
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::get('cart', [CartController::class, 'index'])->name('carts.index');
    Route::get('cart/{product}', [CartController::class, 'store'])->name('carts.add');
    Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::patch('cart/{cart}', [CartController::class, 'update'])->name('carts.update');
    Route::get('sellers/{seller}', [SellerController::class, 'show'])->name('sellers.show');
});

Route::middleware('auth')->group(function (){

    Route::get('login/redirect', [LoginController::class, 'redirectToHome'])->name('login.redirect');

    Route::prefix('profile/')->group(function (){
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::post('seller', [ProfileController::class, 'updateSeller'])->name('profile.seller')->middleware('can:isSeller');
        Route::post('buyer', [ProfileController::class, 'updateBuyer'])->name('profile.buyer')->middleware('can:isBuyer');
    });

    Route::middleware('can:isAdminOrSellerHasStore')->prefix('manage')->group(function (){
        Route::get('/', [Manage\DashboardController::class, 'index'])->name('manage');

        Route::get('users/{user}', [Manage\UserController::class, 'show'])->name('manage.users.show');
        Route::resource('buyers', Manage\BuyerController::class, ['as' => 'manage'])->only(['index']);
        Route::resource('sellers', Manage\SellerController::class, ['as' => 'manage'])->only(['index']);

        Route::resource('orders', Manage\OrderController::class, ['as' => 'manage'])->only(['index', 'show']);
        Route::patch('orders/{order}/payment/deny', [Manage\OrderController::class, 'denyPayment'])->name('manage.order.deny-payment');
        Route::patch('orders/{order}/payment/accept', [Manage\OrderController::class, 'acceptPayment'])->name('manage.order.accept-payment');
        Route::patch('orders/{order}/payment/deliver', [Manage\OrderController::class, 'deliver'])->name('manage.order.deliver');
        Route::patch('orders/{order}/payment/delivery-complete', [Manage\OrderController::class, 'deliveryComplete'])->name('manage.order.delivery-complete');
        Route::patch('orders/{order}/payment/cancel', [Manage\OrderController::class, 'cancel'])->name('manage.order.cancel');
        Route::patch('orders/{order}/payment/request-refund', [Manage\OrderController::class, 'requestRefund'])->name('manage.order.request-refund');
        Route::patch('orders/{order}/payment/refund', [Manage\OrderController::class, 'refund'])->name('manage.order.refund');
        Route::patch('orders/{order}/payment/refund-complete', [Manage\OrderController::class, 'refundComplete'])->name('manage.order.refund-complete');

        Route::resource('products', Manage\ProductController::class, ['as' => 'manage']);
    });

    Route::middleware('can:isSellerHasStore')->prefix('manage')->group(function (){
        Route::resource('categories', Manage\CategoryController::class, ['as' => 'manage']);

        Route::patch('products/{product}/update-stock', [Manage\ProductController::class, 'updateStock'])->name('manage.products.update-stock');
    });

    Route::middleware('can:isBuyerRegistered')->group(function (){
        Route::get('orders/{type?}', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/cart/{seller}', [OrderController::class, 'create'])->name('orders.create');
        Route::get('orders/detail/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/detail/{order}/payment', [OrderController::class, 'updatePayment'])->name('orders.payment');
        Route::patch('orders/detail/{order}/payment/delivery-complete', [Manage\OrderController::class, 'deliveryComplete'])->name('order.delivery-complete');
        Route::patch('orders/detail/{order}/payment/cancel', [Manage\OrderController::class, 'cancel'])->name('order.cancel');
        Route::patch('orders/detail/{order}/payment/request-refund', [Manage\OrderController::class, 'requestRefund'])->name('order.request-refund');
        Route::patch('orders/detail/{order}/payment/refund-complete', [Manage\OrderController::class, 'refundComplete'])->name('order.refund-complete');
    });
});
