<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::where('role', 'user')->get();
        $posts = Post::all();

        foreach ($posts as $post) {
            $commenters = $users->random(rand(2, 5));

            foreach ($commenters as $user) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                    'comment' => $faker->sentence(rand(5, 12)),
                ]);
            }
        }
    }
}
