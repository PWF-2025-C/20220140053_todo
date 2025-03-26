<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo; // Pastikan Anda juga mengimpor model Todo
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini
use Illuminate\Support\Str; // Tambahkan ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        User::factory(101)->create();
        Todo::factory(500)->create();
    }
}
