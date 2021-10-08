<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'name',
        'order',
        'description',
        'quantity',
        'total_amount',
        'balance',
        'status',
        'restaurant_id',
    ];

    public function daily_payment()
    {
        return $this->hasMany(Payment::class);
    }
}
