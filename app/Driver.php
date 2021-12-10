<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'driver_name',
        'plate_no',
        'address',
        'contact',
        'email',
        'file',
        'status',
        'restaurant_id',
    ];

    public function daily_sale()
    {
        return $this->hasOne(DailySale::class);
    }
   
    public function Notification()
    {
        return $this->hasOne(Notification::class);
    }
}
