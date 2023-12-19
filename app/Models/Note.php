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
        'username',
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
        if (isset($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('content', 'like', '%' . $filters['search'] . '%')
                ->orWhere('priority', 'like', '%' . $filters['search'] . '%')
                ->orWhere('deadline', 'like', '%' . $filters['search'] . '%')
                ->orWhere('tags', 'like', '%' . $filters['search'] . '%')
                ->orWhere('username', 'like', '%' . $filters['search'] . '%');
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
