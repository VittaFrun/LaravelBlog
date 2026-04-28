<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'img_path',
        'user_id',
        'category_id',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->img_path) {
            return asset('storage/posts/default.jpg');
        }
        
        if (str_starts_with($this->img_path, 'http')) {
            return $this->img_path;
        }

        return asset('storage/' . $this->img_path);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
