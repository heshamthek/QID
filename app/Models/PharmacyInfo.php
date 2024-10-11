<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PharmacyInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 
        'owner_name', 
        'location', 
        'pharmacy_name', 
        'phone_number',
        'license_image', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

