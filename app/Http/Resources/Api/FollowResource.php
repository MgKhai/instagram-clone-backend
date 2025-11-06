<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $authUser = Auth::user();

        return [
            'id'            => $this->id,
            'followerId'   => $this->follower_id,
            'followingId'  => $this->following_id,
            'follower' => [
                'id'    => $this->follower?->id,
                'name'  => $this->follower?->name,
                'email' => $this->follower?->email,
            ],
            'following' => [
                'id'    => $this->following?->id,
                'name'  => $this->following?->name,
                'email' => $this->following?->email,
            ],
            'isFollowing' => true
        ];
    }
}
