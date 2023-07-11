<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = [
            [
            'name'        => 'Politica',
            'description' => $faker->words(rand(10, 60), true),
            ],
            
            [
            'name'        => 'Informatica',
            'description' => $faker->words(rand(10, 60), true),
            ],

            [
            'name'        => 'Scuola',
            'description' => $faker->words(rand(10, 60), true),
            ],

            [
            'name'        => 'Attualità',
            'description' => $faker->words(rand(10, 60), true),
            ],

            [
            'name'        => 'Cronaca',
            'description' => $faker->words(rand(10, 60), true),
            ],

            [
            'name'        => 'Cucina',
            'description' => $faker->words(rand(10, 60), true),
            ],
        ];

        foreach($categories as $category){
            Category::create($category);
        }
    }
}
