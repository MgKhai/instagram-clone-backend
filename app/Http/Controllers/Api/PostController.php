<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;

class PostController extends Controller
{
    use ApiResponse;
    /**
     * retrieve a list of posts
     */
    public function index(){
        $posts = Post::all();

        if($posts->isEmpty()){
            return $this->errorResponse('Posts not found', 404);
        }

        // return a list of posts
        return $this->successResponse('Posts retrieved successfully', PostResource::collection($posts), 200);
    }

}
