<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use Sortable;
    use Notifiable;
    use HasApiTokens;

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


