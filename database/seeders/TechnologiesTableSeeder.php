<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'technologies'  => 'php',
            ],
            [
                'technologies'  => 'js',
            ],
            [
                'technologies'  => 'html',
            ],
            [
                'technologies'  => 'css',
            ],
            [
                'technologies'  => 'laravel',
            ],
            [
                'technologies'  => 'bootstrap',
            ],
            [
                'technologies'  => 'Vue.js',
            ],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
