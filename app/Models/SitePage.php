<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_markup',
        'html_content',
        'css_content',
        'components_json',
        'styles_json',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'components_json' => 'array',
    ];
}
