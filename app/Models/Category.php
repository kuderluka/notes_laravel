<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory;
    use Sortable;

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'color'
    ];

    public $sortable = [
        'title',
        'color'
    ];

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('color', 'like', '%' . request('search') . '%');
        }
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
