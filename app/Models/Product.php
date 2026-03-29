<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'seller_id', 'category_id', 'title', 'slug', 'description',
        'price', 'sale_price', 'thumbnail', 'images', 'type',
        'file_url', 'stock', 'downloads', 'status',
    ];

    protected function casts(): array
    {
        return [
            'images'     => 'array',
            'price'      => 'float',
            'sale_price' => 'float',
        ];
    }

    public function seller()   { return $this->belongsTo(User::class, 'seller_id'); }
    public function category() { return $this->belongsTo(ProductCategory::class); }
    public function reviews()  { return $this->hasMany(Review::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }

    public function scopeActive($query) { return $query->where('status', 'active'); }

    public function getEffectivePriceAttribute(): float
    {
        return $this->sale_price ?? $this->price;
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->where('approved', true)->avg('rating') ?? 0, 1);
    }
}
