<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\FollowerSeeder;
use Database\Seeders\PostMediaSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            PostMediaSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class,
            FollowerSeeder::class,
        ]);
    }
}

