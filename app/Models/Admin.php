<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'two_factor_code', 'two_factor_expires_at',
        'last_login_ip', 'last_login_at', 'is_active'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'two_factor_expires_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    public function activityLogs()
    {
        return $this->hasMany(AdministrativeLog::class, 'admin_id');
    }
}
