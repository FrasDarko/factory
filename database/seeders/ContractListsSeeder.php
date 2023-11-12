<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ContractList;

class ContractListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed for user 1 and products 1-5
        for ($i = 1; $i <= 5; $i++) { 
            ContractList::create([
                'users_id' => 1,
                'products_id' => $i,
                'price' => rand(1, 50)
            ]);
        }
    }
}
