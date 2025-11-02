<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $fillable = ['post_id','type','url'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
