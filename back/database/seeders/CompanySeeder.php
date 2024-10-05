<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::updateOrCreate(
            ['name' => 'Company A'],
            [
                'address' => '123 Main St',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip_code' => '12345',
                'country' => 'USA',
            ]
        );

        Company::updateOrCreate(
            ['name' => 'Company B'],
            [
                'address' => '456 Elm St',
                'city' => 'Othertown',
                'state' => 'NY',
                'zip_code' => '67890',
                'country' => 'USA',
            ]
        );
    }
}
