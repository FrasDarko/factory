<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 10; $i++) {
            Categories::create([
                "name" => $faker->word . (rand(0, 1) ? " " . $faker->word : ""),
                "description" => $faker->sentence
            ]);
        }
    }
}
