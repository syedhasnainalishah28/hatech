<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'category_id', 'author_id', 'title', 'slug', 'excerpt',
        'body', 'thumbnail', 'status', 'meta_title', 'meta_description',
        'focus_keyword', 'canonical_url', 'read_time', 'published_at',
        'sidebar_left_show', 'sidebar_right_show', 'sidebar_left_type',
        'sidebar_right_type', 'sidebar_left_content', 'sidebar_right_content',
    ];

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }

    public function category() { return $this->belongsTo(BlogCategory::class); }
    public function author()   { return $this->belongsTo(User::class, 'author_id'); }
    public function comments() { return $this->hasMany(BlogComment::class, 'post_id'); }

    public function scopePublished($query) {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->orderByDesc('published_at');
    }
}
