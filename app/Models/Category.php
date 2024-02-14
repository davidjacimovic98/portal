<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    // Relationship with news
    public function news() {
       return $this->hasMany(News::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            // Soft delete all associated news
            $category->news()->delete();
        });
    }
}
