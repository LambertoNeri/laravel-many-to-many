<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::all();
        $tags = Tag::all()->pluck('id');

        for($i = 0; $i < 50; $i++){
          

            $post = Post::create([
                'category_id'   =>  $faker->randomElement($categories)->id,
                'title'         =>  $faker->words(rand(2, 10), true),
                'url_image'     =>  'https://picsum.photos/id/' . rand(1, 270) . '/500/400',
                'content'       =>  $faker->paragraphs(rand(2, 20), true),
            ]);

            // $post->tags()->attach($faker->randomElement($tags)->id);

            $post->tags()->sync($faker ->randomElements($tags, null));
        }
    }
}
