<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\CommentResource;

class CommentController extends Controller
{
    use ApiResponse;
    /**
     * create a comment
     */
    public function store(Request $request){
        try{

            if($request->userId != Auth::user()->id){
                return $this->errorResponse('Fail to comment', 400);
            }

            $comment = Comment::create([
                'user_id' => $request->userId,
                'post_id' => $request->postId,
                'comment' => $request->comment
            ]);

            // success response
            return $this->successResponse('New comment created successfully', new CommentResource($comment), 200);

        }catch(\Exception $error){
            // error response
            return $this->errorResponse('Fail to comment: '. $error->getMessage(), 500);
        }
    }
}
