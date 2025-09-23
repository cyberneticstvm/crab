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
            'password' => Hash::make('softbugs'),
            'role' => 'admin',
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
