<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'layout_sections',
        'category',
        'year',
        'image_path',
        'case_study_url',
        'order',
        'is_active',
        'is_featured'
    ];

    protected $casts = [
        'layout_sections' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];
}
