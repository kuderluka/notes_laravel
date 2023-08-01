<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class User extends Model
{
    use HasFactory;
    use Sortable;

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'username',
        'email',
        'password',
        'image'
    ];

    public $sortable = [
        'id',
        'username',
        'email',
        'password',
        'image'
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}


