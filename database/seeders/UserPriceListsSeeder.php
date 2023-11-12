<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserPriceLists;

class UserPriceListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 1; $i <= 10; $i++) { 
            UserPriceLists::create([
                'users_id' => 1,
                'price_list_id' => $i            
            ]);
        }        
    }
}
