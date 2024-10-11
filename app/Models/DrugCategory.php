<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_name'];

    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }
}

