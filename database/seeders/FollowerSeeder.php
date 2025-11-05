<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {

            $toFollow = $users->where('id', '!=', $user->id)->random(rand(2, 5));

            foreach ($toFollow as $followed) {
                Follower::firstOrCreate([
                    'follower_id' => $user->id,
                    'following_id' => $followed->id,
                ]);
            }
        }
    }
}
