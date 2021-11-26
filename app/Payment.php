<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'dailysales_id',
        'amount',
        'payment',
        'status',
        'date',
        'restaurant_id',
    ];

    public function dailysale()
    {
        return $this->belongsTo(DailySale::class, 'dailysales_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_id');
    }
}
