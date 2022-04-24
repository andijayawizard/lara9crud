<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $password = bcrypt('password');
        $faker = Factory::create();
        $user1 = User::create(['name' => $faker->name, 'email' => $faker->email, 'password' => $password]);
        $user2 = User::create(['name' => $faker->name, 'email' => $faker->email, 'password' => $password]);
    }
}