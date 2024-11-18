<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkout';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'name',
        'city',
        'zipcode',
        'street',
        'house_number',
        'total_price'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
