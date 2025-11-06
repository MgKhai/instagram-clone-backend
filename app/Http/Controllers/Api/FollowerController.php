<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\FollowResource;

class FollowerController extends Controller
{
    use ApiResponse;
    /**
     * follow or unfollow
     */
    public function toggleFollow(Request $request){
        try{
            $followerId = $request->followerId;
            $followingId = $request->followingId;

            // check auth login user
            if($followerId != Auth::user()->id){
                return $this->errorResponse('Fail to follow', 400);
            }

            // not allow follow itself
            if($followerId == $followingId){
                return $this->errorResponse('Fail to follow', 400);
            }

            // check already follow
            $existing = Follower::where('follower_id', $followerId)
              ->where('following_id', $followingId)
              ->first();

            if($existing){

                $existing->delete();
                $content = ['isFollowing' => false];
                // success
                return $this->successResponse('Unfollowed successfully', $content, 200);

            }else{
                $follow = Follower::create([
                    'follower_id' => $followerId,
                    'following_id' => $followingId,
                ]);
                // success
                return $this->successResponse('Followed successfully', new FollowResource($follow), 200);
            }
        }catch(\Exception $error){
            //error
            return $this->errorResponse('Fail to follow: '. $error->getMessage(), 500);
        }

    }

    /**
     * retrieve followers list
     */
    public function followers($id){
        try{
            $user = User::findOrFail($id);
            if(!$user){
                return $this->errorResponse('User not found', 404);
            }

            $followers = $user->followers()->with('follower')->get();
            // success
            return $this->successResponse('Followers list retrieved successfully', FollowResource::collection($followers), 200);
        }catch(\Exception $error){

            //error
            return $this->errorResponse('Retrieving followers list fails: '. $error->getMessage(), 500);
        }
    }

    /**
     * retrieve following list
     */
    public function following($id){
        try{
            $user = User::findOrFail($id);
            if(!$user){
                return $this->errorResponse('User not found', 404);
            }

            $followings = $user->following()->with('following')->get();
            // success
            return $this->successResponse('Following list retrieved successfully', FollowResource::collection($followings), 200);
        }catch(\Exception $error){

            //error
            return $this->errorResponse('Retrieving followings list fail: '. $error->getMessage(), 500);
        }
    }


}
