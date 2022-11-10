<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = [
        'user_id',
        'type',
        'action',
        'ip'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
