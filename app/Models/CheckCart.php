<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckCart extends Model
{
    protected $table = 'check_cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function product()
    {
        return $this->belongsTo(StockUpdateModel::class, 'product_id');
    }
    use HasFactory;
}
