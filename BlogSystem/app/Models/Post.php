<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
