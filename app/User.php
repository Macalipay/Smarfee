<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'restaurant_id', 'lastname', 'email', 'designation', 'address', 'password', 'contact_number', 'picture', 'city_id', 'driver_id'
    ];

    public function notification_user()
    {
        return $this->hasOne(Notification::class);
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function user()
    {
        return $this->hasOne(Attendance::class);
    }

    public function user_expense()
    {
        return $this->hasOne(Expense::class);
    }

    public function DailySale()
    {
        return $this->hasOne(DailySale::class);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
