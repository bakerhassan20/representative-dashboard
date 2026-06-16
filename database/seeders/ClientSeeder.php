<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 30; $i++) {

            Client::create([
                'name'  => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'address' => $faker->address(),
            ]);
        }
    }
}