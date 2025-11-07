<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\FollowResource;
use App\Http\Resources\Api\FollowerListResource;
use App\Http\Resources\Api\FollowingListResource;
use App\Http\Resources\Api\MutualFollowerResource;

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
     * retrieve follower list
     */
    public function followers($id){
        try{
            $followers = Follower::where('following_id',$id)->with('follower')->get();

            if(!$followers){
                return $this->errorResponse('Followers not found', 404);
            }

            // success
            return $this->successResponse('Followers list retrieved successfully', FollowerListResource::collection($followers), 200);
        }catch(\Exception $error){

            //error
            return $this->errorResponse('Retrieving followers list fails: '. $error->getMessage(), 500);
        }
    }

    /**
     * retrieve follower list
     */
    public function following($id){
        try{
            $followings = Follower::where('follower_id', $id)->with('following')->get();

            if(!$followings){
                return $this->errorResponse('Followings not found', 404);
            }

            // success
            return $this->successResponse('Following list retrieved successfully', FollowingListResource::collection($followings), 200);
        }catch(\Exception $error){

            //error
            return $this->errorResponse('Retrieving followings list fail: '. $error->getMessage(), 500);
        }
    }

    /**
     * retrieve mutual followers list
     */
    public function mutualFollowers($id)
    {
        try{

            if($id == Auth::user()->id){
                return $this->errorResponse('Fail request', 400);
            }

            if (!User::where('id', $id)->exists()) {
                return $this->errorResponse('Users not found', 404);
            }

            $authId = Auth::user()->id;
            $profileUserId = $id;


            $authUserFollowings = Follower::where('follower_id', $authId)
                ->pluck('following_id');

            $profileFollowers = Follower::where('following_id', $profileUserId)
                ->pluck('follower_id');

            $mutualIds = $authUserFollowings->intersect($profileFollowers);

            $mutualUsers = User::whereIn('id', $mutualIds)->get();

            if($mutualIds->isempty()){
                return $this->errorResponse('Mutual followers not found', 404);
            }

            return $this->successResponse('Mutual followers list retrieved successfully', [
                'mutual_followers' => MutualFollowerResource::collection($mutualUsers),
                'mutual_count'     => $mutualUsers->count(),
            ], 200);
        }catch(\Exception $error){
            //error
            return $this->errorResponse('Retrieving mutual followers list fail: '. $error->getMessage(), 500);
        }

    }


}
