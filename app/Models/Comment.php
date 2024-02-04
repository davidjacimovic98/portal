<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'news_id'];

    // Relationship with user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with news
    public function news() {
        return $this->belongsTo(News::class, 'news_id');
    }
}
