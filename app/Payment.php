<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id',
        'sales_order_id',
        'amount',
        'payment_type',
        'date',
        'created_at',
        'updated_at'
    ];

    public function sales_order()
    {
        return $this->belongsTo(SalesOrder::class, 'sales_order_id');
    }
}
