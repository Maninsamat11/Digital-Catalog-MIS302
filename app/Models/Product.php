<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'product_name', 'brand', 'description',
        'price', 'stock_quantity', 'product_image', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function interactions()
    {
        return $this->hasMany(UserInteraction::class);
    }
}
