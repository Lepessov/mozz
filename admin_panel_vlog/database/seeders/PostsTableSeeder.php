<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Post 1',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'visibility' => 'PUBLIC',
                'user_id' => 1,
                'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fbuffer.com%2Flibrary%2Ffree-images%2F&psig=AOvVaw3woCfyk7GF1TB5SQ2wvV8x&ust=1712293853557000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCNCUhOnlp4UDFQAAAAAdAAAAABAE'
            ],
            [
                'title' => 'Post 2',
                'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'visibility' => 'PRIVATE',
                'user_id' => 2,
                'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fbuffer.com%2Flibrary%2Ffree-images%2F&psig=AOvVaw3woCfyk7GF1TB5SQ2wvV8x&ust=1712293853557000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCNCUhOnlp4UDFQAAAAAdAAAAABAE'
            ],
        ];

        foreach ($posts as $post) {
            $newPost = Post::create($post);

            $categories = Category::all()->random(2);
            $newPost->categories()->attach($categories);
        }
    }
}
