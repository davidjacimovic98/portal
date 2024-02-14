<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['title', 'description', 'tags', 'logo', 'user_id', 'category_id'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('tags', 'like', '%' . request('search') . '%')
                    ->orWhere('title', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship with user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with comments
    public function comments() {
        return $this->hasMany(Comment::class, 'news_id');
    }

    // Relationship with tags
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    // Relationship with category
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
