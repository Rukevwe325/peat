<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'price',
        'model',
        'year',
        'description',
        'image_1',
        'image_2',
        'image_3',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
