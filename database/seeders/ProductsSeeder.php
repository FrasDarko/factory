<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 20; $i++) {
            Products::create([
                "name" => $faker->word . (rand(0, 1) ? " " . $faker->word : ""),
                "description" => $faker->sentence,
                "sku" => substr(md5(rand()), 0, 6),
                "price" => rand(1, 200) + 50,
                "published" => rand(0, 1)
            ]);
        }
    }
}
