<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'owner_name',
        'store_name',
        'address',
        'contact',
        'email',
        'status',
        'type',
        'map',
        'city_id',
        'image',
    ];

    public function user_restaurant()
    {
        return $this->hasOne(User::class);
    }
}
