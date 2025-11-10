<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\PostMedia;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','caption'];

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
