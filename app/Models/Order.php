<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const ORDER_WAITING = 1;
    const ORDER_COMPLETED = 2;
    const CANCELED = 3;

    const status = [
        self::ORDER_WAITING => 'Menunggu Konfirmasi',
        self::ORDER_COMPLETED => 'Pesanan Selesai',
        self::CANCELED => 'Dibatalkan',
    ];

    public function buyer(){
        return $this->belongsTo('App\Models\Buyer');
    }

    public function seller(){
        return $this->belongsTo('App\Models\Seller');
    }

    public function details(){
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function tracks(){
        return $this->hasMany('App\Models\Track');
    }

    public function getNoInvoiceAttribute(){
        $romawi = [null,"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII"];
        return "INV/{$this->created_at->year}/{$romawi[$this->created_at->month]}/{$this->id}";
    }

    public function getStatusAttribute(){
        return key_exists($this->status_code, self::status)
            ? __(self::status[$this->status_code])
            : __('Tidak Diketahui');
    }
}
