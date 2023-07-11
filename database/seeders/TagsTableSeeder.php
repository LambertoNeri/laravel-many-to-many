<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name' => 'maturità',
            ],
            [
                'name' => 'estero',
            ],
            [
                'name' => 'scuola',
            ],
            [
                'name' => 'trasporti',
            ],
            [
                'name' => 'piatti',
            ],
            [
                'name' => 'pesce',
            ],
            [
                'name' => 'auto',
            ],
            [
                'name' => 'moto',
            ],
            [
                'name' => 'bici',
            ],
            [
                'name' => 'scarpe',
            ],
            [
                'name' => 'vestiti',
            ],
        ];
        
        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
