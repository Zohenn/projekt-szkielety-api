<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'address',
        'postal_code',
        'city',
        'phone',
        'payment_type_id',
        'value',
        'assembly',
        'os_installation',
    ];

    protected $dates = ['date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function paymentType() {
        return $this->belongsTo(PaymentType::class);
    }

    public function orderStatus() {
        return $this->belongsTo(OrderStatus::class);
    }

    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
}
