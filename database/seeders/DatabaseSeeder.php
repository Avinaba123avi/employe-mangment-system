<?php

namespace Database\Seeders;

use App\Models\roles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\student;
use App\Models\users;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //roles::factory()->count(3)->create();
        //users::factory()->count(10)->create();
        $this->call([
            UserRoleSeeder::class,
        ]);
    }
}
