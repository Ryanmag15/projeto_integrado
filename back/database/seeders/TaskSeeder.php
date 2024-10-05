<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::updateOrCreate(
            ['title' => 'Task 1'],
            [
                'description' => 'Description for task 1',
                'client_id' => Client::where('name', 'Client A')->first()->id,
                'user_id' => User::where('email', 'ryanmag15@gmail.com')->first()->id,
            ]
        );

        Task::updateOrCreate(
            ['title' => 'Task 2'],
            [
                'description' => 'Description for task 2',
                'client_id' => Client::where('name', 'Client B')->first()->id,
                'user_id' => User::where('email', 'ryanmag15@gmail.com')->first()->id,
            ]

        );

        
    }
}
