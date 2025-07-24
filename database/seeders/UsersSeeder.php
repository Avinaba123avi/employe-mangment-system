<?php

namespace Database\Seeders;

use App\Models\users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            users::create([
                "name"=> fake()->name(),
                "email"=> fake()->email(),
                "password"=> fake()->password(),
                "role_id" => rand(1,3)
            ]);
            users::create([
                "name"=> fake()->name(),
                "email"=> fake()->email(),
                "password"=> fake()->password(),
                "role_id" => rand(1,3)
            ]);
            users::create([
                "name"=> fake()->name(),
                "email"=> fake()->email(),
                "password"=> fake()->password(),
                "role_id" => rand(1,3)
            ]);
    }
}
