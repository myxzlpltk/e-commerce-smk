<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use App\Observers\SellerObserver;
use App\Observers\UserObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        Product::observe(ProductObserver::class);
        Seller::observe(SellerObserver::class);
        User::observe(UserObserver::class);

        Relation::morphMap([
            'buyer' => 'App\Models\Buyer',
            'seller' => 'App\Models\Seller',
        ]);

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        View::composer('layouts.default.app', function ($view){
            $view->with('sortedSellers', Seller::query()->orderBy('store_name')->get());
        });
    }
}
