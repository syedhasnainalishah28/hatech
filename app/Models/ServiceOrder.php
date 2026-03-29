<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'service_name',
        'requirements',
        'requirements_file',
        'status',
        'price',
        'project_tech',
        'tech_stack',
        'budget',
        'timeline',
        'custom_responses'
    ];

    protected $casts = [
        'custom_responses' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updates()
    {
        return $this->hasMany(ServiceOrderUpdate::class)->latest();
    }
}
