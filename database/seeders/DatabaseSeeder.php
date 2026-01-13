<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ActivitySeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Panggil AdminSeeder agar akun admin dibuat
        $this->call(AdminSeeder::class);
        // Seeder aktivitas
        $this->call(ActivitySeeder::class);
    }
}
