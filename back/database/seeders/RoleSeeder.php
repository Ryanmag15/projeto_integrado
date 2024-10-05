<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'Admin'], ['name' => 'Admin']);
        Role::updateOrCreate(['name' => 'Manager'], ['name' => 'Manager']);
        Role::updateOrCreate(['name' => 'User'], ['name' => 'User']);
    }
}
