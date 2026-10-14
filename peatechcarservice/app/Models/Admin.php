<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens; // ✅

    protected $guard = 'admin';

    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'phone',
        'email',
        'password',
        'profile_photo',
        'start_datetime',
        'end_datetime',
        'available_range',
        'role',
        'longitude',
        'latitude',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}