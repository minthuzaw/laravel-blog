<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//    protected $guarded = [];

    protected $with = ['category', 'author']; //solve N+1

    //query scope for search
    public function scopeFilter($query, array $filters)
    {
        $author = $filters['author'] ?? false;
        $search = $filters['search'] ?? false;
        $category = $filters['category'] ?? false;
        $query->when($author,
            fn() => $query->whereHas('author', fn($query) => $query->where('username', $author)),//for author filter
            fn($query) => $query->when($search, fn($query, $search) => $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
                ->orWhere('excerpt', 'like', '%' . $search . '%'))//for search anything user write
            ->when($category, fn($query, $category) => $query
                ->whereHas('category', fn($query) => $query->where('slug', $category)//for search category
                )
            )
        );
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
