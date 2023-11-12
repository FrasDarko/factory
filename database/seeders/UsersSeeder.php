<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Users;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 20; $i++) {
            Users::create([
                "firstName" => $faker->firstName,
                "lastName" => $faker->lastName,
                "email" => $faker->email,
                "phone" => $faker->phoneNumber,
                "address" => $faker->address,
                "city" => $faker->city,
                "country" => $faker->country,
            ]);
        }
    }
}
