<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'daily_sale_id',
        'user_id',
        'driver_id',
        'description',
        'status',
    ];

    public function dailysale_notif()
    {
        return $this->belongsTo(DailySale::class, 'daily_sale_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
