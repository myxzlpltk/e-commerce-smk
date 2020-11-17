<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_name',
        'account_number',
        'address',
        'bank_id',
        'phone_number',
        'user_id',
    ];

    public function bank(){
        return $this->belongsTo('App\Models\Bank');
    }

    public function user(){
        return $this->morphOne('App\Models\User',__FUNCTION__, 'role', 'id', 'user_id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    public function carts(){
        return $this->hasMany('App\Models\Cart');
    }
}
