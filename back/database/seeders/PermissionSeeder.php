<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::updateOrCreate(['name' => 'create_client'], ['name' => 'create_client']);
        Permission::updateOrCreate(['name' => 'edit_client'], ['name' => 'edit_client']);
        Permission::updateOrCreate(['name' => 'delete_client'], ['name' => 'delete_client']);
        Permission::updateOrCreate(['name' => 'view_client'], ['name' => 'view_client']);
    }
}
