<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MutualFollowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            // 'nickname' => $this->nickname ?? null,
            'email'    => $this->email,
            // 'profile_image' => $this->profile_image
            //     ? asset('storage/' . $this->profile_image)
            //     : asset('images/default-avatar.png'),
        ];
    }
}
