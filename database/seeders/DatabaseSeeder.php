<?php

namespace Database\Seeders;

use App\Models\PaymentMode;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Soft Bugs',
            'email' => 'mail@softbugs.in',
            'password' => Hash::make('Welcome@2026'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Sajji Karunakaran',
            'email' => 'karunakaransajji50@gmail.com',
            'password' => Hash::make('sajjik'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Shyam',
            'email' => 'shyamkris.mg@gmail.com',
            'password' => Hash::make('shyamkris'),
            'role' => 'staff',
        ]);

        User::factory()->create([
            'name' => 'Crab Care',
            'email' => 'crabcare2020@gmail.com',
            'password' => Hash::make('crabcare2020'),
            'role' => 'staff',
        ]);

        $pmodes = [
            'Cash',
            'Bank',
            'Cheque',
            'UPI',
            'Other'
        ];

        foreach ($pmodes as $pmode) {
            PaymentMode::insert(['name' => $pmode]);
        }
    }
}
