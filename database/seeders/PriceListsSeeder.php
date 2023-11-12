<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PriceList;

class PriceListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 pricelists
        for ($i = 1; $i <= 10; $i++) { 
            PriceList::create([
                'name' => 'priceList' . $i,
                'description' => 'priceListDescription' . $i
            ]);
        }        
    }
}
