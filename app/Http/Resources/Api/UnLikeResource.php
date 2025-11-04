<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class UnLikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();

        return [
            'id'           => $this->id,
            'postId'       => $this->post_id,
            'likeCount' => $this->post ? $this->post->likes()->count() : 0,
            'isLiked'      => $user ? $this->post->likes()->where('user_id', $user->id)->exists() : false,
        ];
    }
}
