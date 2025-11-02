<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostMedia;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $postIds = Post::select('id')->get();

        foreach ($postIds as $postId) {
            PostMedia::create([
                'post_id' => $postId->id,
                'type'    => 'image',
                'url'     => 'https://thumbs.dreamstime.com/b/idyllic-summer-landscape-clear-mountain-lake-alps-45054687.jpg',
            ]);
        }
    }
}
