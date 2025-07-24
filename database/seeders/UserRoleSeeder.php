<?php

namespace Database\Seeders;

use App\Models\userrole;
use App\Models\usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        usertype::create(['user_type' => 'admin']);
        usertype::create(['user_type'=> 'manager']);
        usertype::create(['user_type'=> 'employee']);
    }
}
