<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'tokopedia_id',
        'name',
        'slug',
        'description',
        'price',
        'image_url',
        'tokopedia_url',
        'is_active',
        'last_synced_at',
    ];

    protected $casts = [
        'price' => 'integer',
        'is_active' => 'boolean',
        'last_synced_at' => 'datetime',
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}

