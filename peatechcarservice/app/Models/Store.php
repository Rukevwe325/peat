<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'admin_id',
        'store_name',
        'store_address',
        'state',
        'image_one',
        'image_two',
        'registration_doc',
        'available_hours',
        'is_verified', // optional if you want to track verification
    ];

    /**
     * Relationship: Store belongs to an Admin
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
