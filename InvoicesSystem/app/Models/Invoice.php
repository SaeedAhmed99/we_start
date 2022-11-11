<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;


class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'invoice_number',
        'orginal_price',
        'rate_vat',
        'value_vat',
        'total',
        'status',
        'note',
        'product_id',
        'user_id',
    ];


    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Product() {
        return $this->belongsTo(User::class, 'product_id', 'id');
    }
}
