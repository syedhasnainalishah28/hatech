<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrderUpdate extends Model
{
    protected $fillable = [
        'service_order_id',
        'message',
        'proof_image',
    ];

    public function serviceOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }
}
