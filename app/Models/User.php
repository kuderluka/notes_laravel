<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class User extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'id',
        'username',
        'email',
        'password',
        'image',
    ];

    public function note()
    {
        return $this->hasOne(Note::class, 'user', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'user', 'id');
    }

    public function categories()
    {
        //return $this->belongsToMany(Category::class,'category_user','user_id', 'category_id');
        return $this->belongsToMany(Category::class);
    }
}


