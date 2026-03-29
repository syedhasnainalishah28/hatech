<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'read', 'replied_at'];

    protected function casts(): array
    {
        return ['read' => 'boolean', 'replied_at' => 'datetime'];
    }
}
