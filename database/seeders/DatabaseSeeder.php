<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
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
        $this->call([
            UserSeeder::class,
            MenuSeeder::class,
            SocialMediaSeeder::class
        ]);
    }

    // untuk memanggil 1 seeder saja, gunakan command berikut di terminal:
    // php artisan db:seed --class=MenuSeeder
}
