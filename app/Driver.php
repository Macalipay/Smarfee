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
    ];
}
