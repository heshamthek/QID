<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugWarehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['warehouse_name', 'logo'];

    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }
    public function users()
{
    return $this->belongsToMany(User::class, 'user_warehouse', 'warehouse_id', 'user_id');
}

}


