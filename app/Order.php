<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'daily_sale_id',
        'inventory_id',
        'quantity',
        'amount',
        'total',
        'restaurant_id',
    ];

    public function dailySale()
    {
        return $this->hasMany(Order::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function sale()
    {
        return $this->belongsTo(DailySale::class, 'daily_sale_id');
    }
}
