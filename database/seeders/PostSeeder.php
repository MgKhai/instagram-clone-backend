<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = User::where('role','user')->select('id')->get();


        foreach($userIds as $userId) {
            Post::create([
                'user_id' => $userId->id,
                'caption' => $faker->sentence(),
            ]);
        }
    }
}
