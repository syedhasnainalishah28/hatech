<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'name', 'email', 'body', 'approved'];

    protected function casts(): array
    {
        return ['approved' => 'boolean'];
    }

    public function post() { return $this->belongsTo(BlogPost::class); }
    public function user() { return $this->belongsTo(User::class); }
}
