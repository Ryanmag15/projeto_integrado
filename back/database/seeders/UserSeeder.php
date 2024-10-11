<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criação de um usuário admin
        User::updateOrCreate(
            ['email' => 'ryanmag15@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('123456'),
                'role_id' => Role::where('name', 'Admin')->first()->id,
            ]
        );

        // Criação de um usuário admin
        User::updateOrCreate(
            ['email' => 'junilson.pereira@sga.pucminas.br'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('123456'),
                'role_id' => Role::where('name', 'Admin')->first()->id,
            ]
        );

        // Criação de um usuário manager
        User::updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'password' => bcrypt('password'),
                'role_id' => Role::where('name', 'Manager')->first()->id,
            ]
        );

        // Criação de um usuário comum
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('password'),
                'role_id' => Role::where('name', 'User')->first()->id,
            ]
        );
    }
}
