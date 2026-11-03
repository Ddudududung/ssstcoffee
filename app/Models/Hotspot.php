<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
        'target_section',
        'action_text',
        'x_percent',
        'y_percent',
        'sort_order',
    ];

    protected $casts = [
        'x_percent' => 'float',
        'y_percent' => 'float',
        'sort_order' => 'integer',
    ];
}

