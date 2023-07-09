<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'color'
    ];

    public function users()
    {
        //return $this->belongsToMany(User::class, 'category_user', 'category_id', 'user_id');
        return $this->belongsToMany(User::class);
    }
}
