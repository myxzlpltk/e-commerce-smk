<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@welcome');

Route::get('login/google', 'LoginController@redirectToProvider')->name('login.google');
Route::get('login/google/callback', 'LoginController@handleProviderCallback')->name('login.google.callback');
Route::get('register/google', 'RegisterController@redirectToProvider')->name('register.google');
Route::get('register/google/callback', 'RegisterController@handleProviderCallback')->name('register.google.callback');

Route::middleware('auth')->group(function (){

    Route::get('profile', 'ProfileController@profile')->name('profile');

    Route::middleware('can:isAdmin')->prefix('admin/')->group(function (){
        Route::view('/', 'admin.dashboard')->name('admin.dashboard');

        Route::prefix('buyers')->group(function (){
            Route::get('/', 'BuyersController@list')->name('admin.buyers.list');
        });

        Route::prefix('sellers')->group(function (){
            Route::get('/', 'SellersController@list')->name('admin.sellers.list');
        });
    });
});
