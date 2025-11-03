<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\PostResource;
use Illuminate\Support\Facades\Validator;

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

    /**
     * create a new post
     */
    public function store(Request $request){
        // check validation post data input
        $validator = Validator::make($request->all(), [
            'userId'  => 'required',
            'caption' => 'nullable',
            'url'     => 'required|file|mimes:png,jpg,jpeg,webp,svg,gif,avif',
        ]);

        // return error if validation fails
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),422);
        }

        // check auth user
        if( $request->userId != Auth::user()->id ){
            return $this->errorResponse('New post creation fails', 500);
        }

        // save image in public folder
        $imageFile = $request->file('url');
        $imageName = uniqid().$request->file('url')->getClientOriginalName();
        $imageFile->move(public_path().'/postImage',$imageName);

        // error handling state
        try{
            $postData = Post::create([
                'user_id' => $request->userId,
                'caption' => $request->caption
            ]);


            $postData->media()->create([
                'url'  => $imageName,
                'type' => 'image',
            ]);

            // success response
            return $this->successResponse('New post created successfully',new PostResource($postData),200);

        }catch(\Exception $error) {
            // error response
            return $this->errorResponse('New post creation fails: ' . $error->getMessage(), 500);
        }
    }

}
