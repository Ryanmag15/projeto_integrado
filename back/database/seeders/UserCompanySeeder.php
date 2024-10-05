<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Database\Seeder;

class UserCompanySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::first();
        $company = Company::first();

        UserCompany::factory()->create([
            'user_id' => $user->id,
            'company_id' => $company->id
        ]);

    }
}
