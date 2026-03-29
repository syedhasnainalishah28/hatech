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
        'category',
        'year',
        'image_path',
        'case_study_url',
        'order',
        'is_active',
        'is_featured'
    ];
}
