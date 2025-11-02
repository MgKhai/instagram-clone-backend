<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $data = [
            'user' => [
                'id'           => $this['user']->id,
                'userName'     => $this['user']->name,
                'email'        => $this['user']->email,
                'profileImage' => $this['user']->profile_image,
                'phone'        => $this['user']->phone,
                'address'      => $this['user']->address,
                'bio'          => $this['user']->bio,
                'role'         => $this['user']->role,
                'createdAt'    => $this['user']->created_at,
                'updatedAt'    => $this['user']->updated_at,
            ],
            'token' => $this['accessToken'],
            // 'refresh_token' => $this['refreshToken'] ?? ''
       ];

        return $data;
    }
}
