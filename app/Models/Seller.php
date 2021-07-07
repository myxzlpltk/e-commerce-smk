<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model{

    use HasFactory;

    public function user(){
        return $this->morphOne('App\Models\User',__FUNCTION__, 'role', 'id', 'user_id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }

    public function categories(){
        return $this->hasMany('App\Models\Category');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    public function successOrders(){
        return $this->hasMany('App\Models\Order')
            ->where('status_code', Order::ORDER_COMPLETED);
    }
}
