<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarPurchase extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'car_details',
        'amount',
        'paystack_reference',
        'status',
    ];

    protected $casts = [
        'car_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
