<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'opening_hours',
        'phone',
        'maps_url',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];
}

