<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();
        $categories = Category::all();

        foreach ($posts as $post) {
            $randomCategories = $categories->shuffle()->take(rand(1, 3)); // Select random categories
            $post->categories()->sync($randomCategories->pluck('id')->toArray());
        }
    }
}
