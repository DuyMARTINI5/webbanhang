<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'email',
        'address',
        'total_amount',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}