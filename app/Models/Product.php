<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'amount',
        'description',
        'image'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
