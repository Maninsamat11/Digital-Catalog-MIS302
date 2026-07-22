<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInteraction extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'product_id', 'interaction_type', 'interacted_at'];

    protected $casts = [
        'interacted_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
