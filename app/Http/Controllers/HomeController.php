<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller{

    public function welcome(){
        if(Gate::denies('isBuyerOrGuest')){
            return redirect()->route('login.redirect');
        };

        return view('welcome', [
            'products' => Product::query()->latest()->take(12)->get()
        ]);
    }
}
