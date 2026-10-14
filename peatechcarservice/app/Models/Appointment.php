<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'full_name',
        'phone',
        'car_model',
        'car_photo',
        'preferred_date',
        'preferred_time',
        'service_description',
        'status'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}
