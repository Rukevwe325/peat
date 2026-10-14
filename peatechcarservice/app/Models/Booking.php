<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'service',
        'service_date',
        'car_model',
        'car_photo',
        'special_request',
        'status',
    ];
}
