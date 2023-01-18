<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'desc',
        'smalldesc',
        'price',
        'featured',
        'quantity',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('feature', 1);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function coupons()
    {
        return $this->hasOne(Coupon::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFinalPriceAttribute()
    {
        $coupon = $this->coupons;
        if($coupon) {
            if($coupon->type == 'value') {
                return $this->price - $coupon->value;
            }else {
                return $this->price - (($coupon->value / 100) * $this->price);
            }
        }
        return $this->price;
    }
}
