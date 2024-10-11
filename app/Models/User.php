<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    use Notifiable;

    protected $fillable = [
        'name', 
        'password', 
        'email', 
        'is_admin'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function pharmacyInfo()
    {
        return $this->hasOne(PharmacyInfo::class);
    }
}
