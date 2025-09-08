<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // untuk menjalankan factory ini di terminal, gunakan perintah berikut:
        // php artisan db:seed --class=CategorySeeder

        Category::factory(10)->create();
    }
}
