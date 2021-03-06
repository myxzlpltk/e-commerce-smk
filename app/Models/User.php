<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userable(){
        return $this->morphTo(__FUNCTION__, 'role', 'id', 'user_id');
    }

    public function buyer(){
        return $this->hasOne('App\Models\Buyer');
    }

    public function seller(){
        return $this->hasOne('App\Models\Seller');
    }

    public function getAvatarAttribute(){
        return $this->attributes['avatar'] ?: "default.jpg";
    }

    public function getIsAdminAttribute(){
        return $this->attributes['role'] === 'admin';
    }

    public function getIsSellerAttribute(){
        return $this->attributes['role'] === 'seller';
    }

    public function getIsBuyerAttribute(){
        return $this->attributes['role'] === 'buyer';
    }

}
