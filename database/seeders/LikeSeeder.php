<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role','user')->get();
        $posts = Post::all();

        foreach ($posts as $post) {
            $likedUsers = $users->random(rand(1, 5));
            foreach ($likedUsers as $user) {
                Like::firstOrCreate([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
