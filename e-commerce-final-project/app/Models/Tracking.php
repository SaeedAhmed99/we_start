<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }
}
