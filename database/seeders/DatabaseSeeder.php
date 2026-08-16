<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@hotmail.com',
            'phone' => '1234567890',
            'password' => bcrypt('admin123'),
            'type' => 'admin',
        ]);

        $this->call([
            CategorySeeder::class,
            // ProductSeeder::class,
            XsidePrintedTShirtSeeder::class,
        ]);
    }
}
