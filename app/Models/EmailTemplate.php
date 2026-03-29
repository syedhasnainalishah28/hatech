<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_name',
        'subject',
        'logo_path',
        'brand_name',
        'tagline',
        'content',
        'contact_phone',
        'contact_email',
        'website_url'
    ];
}
