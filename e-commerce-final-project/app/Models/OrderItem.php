<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'product_variation_id',
        'coupon_id',
        'order_id',
        'price',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class)->withDefault();
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class)->withDefault();
    }

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }
}
