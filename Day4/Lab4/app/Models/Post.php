<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{
    use HasFactory; // Add this trait

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
        'image',
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

      // Image URL Accessor
      public function getImageUrlAttribute()
      {
          return $this->image ? Storage::url($this->image) : null;
      }
  
      // Delete image when post is deleted
      protected static function booted()
      {
          static::deleting(function ($post) {
              if ($post->image) {
                  Storage::disk('public')->delete($post->image);
              }
          });
      }
}