<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tags', 'logo', 'user_id'];

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
}
