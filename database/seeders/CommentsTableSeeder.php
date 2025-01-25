<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory(2)->create([
            'tweet_id' => Tweet::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'comment' => fake()->realText(240),
        ]);
    }
}
