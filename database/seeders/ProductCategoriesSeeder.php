<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductCategory;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 10; $i++) { 
            for ($j = 0; $j < 3; $j++) { 
                ProductCategory::create([
                    "productId" => $i,
                    "categoryId" => rand(1, 10)
                ]);
            }
        }
    }
}
