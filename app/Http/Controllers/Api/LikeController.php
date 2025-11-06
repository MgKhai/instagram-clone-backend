<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\LikeResource;
use App\Http\Resources\Api\UnLikeResource;

class LikeController extends Controller
{
    use ApiResponse;
    /**
     * like or unlike
     */
    public function toggleLike(Request $request){
        try{
            $post = Post::findOrFail($request->postId);
            $likedUserId = $request->userId;

            if($likedUserId != Auth::user()->id){
                return $this->errorResponse('Fail to like post', 400);
            }

            $existingLike = Like::where('user_id', $likedUserId)->where('post_id', $post->id)->first();

            if ($existingLike) {
                $existingLike->delete();
                return $this->successResponse('Post unliked successfully', new UnLikeResource($existingLike), 200);

            } else {

                $likePost = Like::create([
                    'user_id' => $likedUserId,
                    'post_id' => $post->id,
                ]);

                return $this->successResponse('Post liked successfully', new LikeResource($likePost), 200);
            }

        }catch(\Exception $error){
            return $this->errorResponse('Post like fails: ' . $error->getMessage(), 500);
        }
    }
}
