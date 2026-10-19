<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Login for the admin panel. Change ADMIN_EMAIL / ADMIN_PASSWORD in .env before seeding a live site.
        // Only on a fresh database, so a changed password is never reset
        if (! User::exists()) {
            User::create([
                'email' => env('ADMIN_EMAIL', 'admin@jayabarman.test'),
                'name' => env('ADMIN_NAME', 'Jaya Barman'),
                'password' => env('ADMIN_PASSWORD', 'Jaya@2026'),
                'role' => 'admin',
                'is_active' => true,
            ]);
        }

        $this->call([
            SettingsSeeder::class,
            ContentSeeder::class,
            CvSeeder::class,
        ]);
    }
}
