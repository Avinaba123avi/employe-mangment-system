<?php

namespace Database\Seeders;

use App\Models\roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        roles::create([
            "role_type"=>'admin',
        ]);
        roles::create([
                'role_type' => 'employer',
            ]);
            roles::create([
                'role_type' => 'jobseeker',
            ]);

    }
}
