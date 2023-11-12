<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\productPriceLists;

class ProductPriceListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) { 
            productPriceLists::create([
                'products_id' => 1,
                'price_list_id' => $i,
                'price' => rand(1, 50)           
            ]);
        }     
    }
}
