<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'critical_level',
        'quantity_stock',
        'type',
        'status',
        'photo',
        'restaurant_id',
    ];

    public function inventory_transaction()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function dailySale()
    {
        return $this->hasMany(DailySale::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function promo()
    {
        return $this->hasOne(Promo::class, 'id', 'inventory_id');
    }
}
