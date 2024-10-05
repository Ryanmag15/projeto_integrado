<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Company;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::updateOrCreate(
            ['email' => 'clienta@example.com'],
            [
                'name' => 'Client A',
                'company_id' => Company::where('name', 'Company A')->first()->id,
            ]
        );

        Client::updateOrCreate(
            ['email' => 'clientb@example.com'],
            [
                'name' => 'Client B',
                'company_id' => Company::where('name', 'Company A')->first()->id,
            ]
        );

        Client::updateOrCreate(
            ['email' => 'clientc@example.com'],
            [
                'name' => 'Client C',
                'company_id' => Company::where('name', 'Company B')->first()->id,
            ]
        );
    }
}
