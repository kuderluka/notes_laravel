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
        'id',
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

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false) {
            $query->where('username', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%');
        }
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}


