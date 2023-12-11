<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Carbon;

class Note extends Model
{
    use HasFactory;
    use Sortable;

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
        'tags',
        'public'
    ];

    public $sortable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'priority',
        'deadline',
        'tags',
        'public'
    ];

    protected $casts = [
        'deadline' => 'datetime:d-m-Y H:i:s',
    ];

    public function getDeadlineAttribute()
    {
        return Carbon::parse($this->attributes['deadline'])->format('d-m-Y H:i:s');
    }

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('content', 'like', '%' . request('search') . '%')
                ->orWhere('priority', 'like', '%' . request('search') . '%')
                ->orWhere('deadline', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
