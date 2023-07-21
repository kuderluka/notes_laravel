<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'title',
        'content',
        'priority',
        'deadline',
        'tags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
