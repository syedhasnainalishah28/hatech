<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar', 'phone', 'status',
        'google_id', 'github_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Allow access to admin panel only for admins
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isSeller(): bool   { return $this->role === 'seller'; }
    public function isBuyer(): bool    { return $this->role === 'buyer'; }

    public function products()  { return $this->hasMany(Product::class, 'seller_id'); }
    public function orders()    { return $this->hasMany(Order::class, 'buyer_id'); }
    public function reviews()   { return $this->hasMany(Review::class); }
    public function blogPosts() { return $this->hasMany(BlogPost::class, 'author_id'); }
}
