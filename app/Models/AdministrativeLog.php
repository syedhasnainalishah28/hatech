<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeLog extends Model
{
    protected $fillable = [
        'admin_id', 'action', 'description', 'ip_address', 'user_agent',
        'device_type', 'os_name', 'browser_name', 'payload'
    ];

    protected $casts = [
        'payload' => 'array'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
