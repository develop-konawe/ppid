<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // untuk menjalankan factory ini di terminal, gunakan perintah berikut:
        // php artisan db:seed --class=NewsSeeder

        News::factory(20)->create();
    }

}
