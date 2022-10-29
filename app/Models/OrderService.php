<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model {
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'service_id',
    ];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
