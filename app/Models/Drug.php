<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'drug_name',
        'drug_description',
        'side_effects',
        'drug_price',
        'drug_quantity',
        'category_id',
        'warehouse_id',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(DrugCategory::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(DrugWarehouse::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

