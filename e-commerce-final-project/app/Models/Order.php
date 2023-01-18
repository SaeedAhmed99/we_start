<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
