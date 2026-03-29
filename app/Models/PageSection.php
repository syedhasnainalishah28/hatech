<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = ['page', 'section_key', 'type', 'value', 'active'];

    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }

    public static function get(string $page, string $key, mixed $default = null): mixed
    {
        $section = static::where('page', $page)
            ->where('section_key', $key)
            ->where('active', true)
            ->first();

        return $section ? $section->value : $default;
    }

    public static function getPage(string $page): array
    {
        return static::where('page', $page)
            ->where('active', true)
            ->pluck('value', 'section_key')
            ->toArray();
    }
}
