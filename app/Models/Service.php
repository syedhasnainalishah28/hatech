<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'gradient_class',
        'custom_fields',
        'file_limit',
        'is_active'
    ];

    protected $casts = [
        'custom_fields' => 'array',
        'is_active' => 'boolean'
    ];
}
