<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Post extends Model
{
    use HasFactory; // Add this trait

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}