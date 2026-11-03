<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price_ice',
        'price_hot',
        'price_half_liter',
        'price_one_liter',
        'is_available',
        'sort_order',
    ];

    protected $casts = [
        'price_ice' => 'integer',
        'price_hot' => 'integer',
        'price_half_liter' => 'integer',
        'price_one_liter' => 'integer',
        'is_available' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

