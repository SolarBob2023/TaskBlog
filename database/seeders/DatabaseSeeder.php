<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(100)->create();
        \App\Models\Category::factory(20)->create();
        $posts = \App\Models\Post::factory(40)->create();
        \App\Models\Comment::factory(100)->create();

        foreach ($users as $user){
            $postIds = $posts->random(5)->pluck('id');
            $user->likedPosts()->attach($postIds);
            $postIds = $posts->random(2)->pluck('id');
            $user->commentedPosts()->attach($postIds,['content' => fake()->sentence(2)]);
        }



    }
}
