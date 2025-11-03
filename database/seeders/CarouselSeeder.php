<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carousel::create([
            'title' => 'Judul 1',
            'Caption' => 'Caption judul 1',
            'image' => 'test.jpg',
            'sort_order' => 1,
        ]);
        Carousel::create([
            'title' => 'Judul 2',
            'Caption' => 'Caption judul 2',
            'image' => 'test.jpg',
            'sort_order' => 2,
        ]);
        Carousel::create([
            'title' => 'Judul 3',
            'Caption' => 'Caption judul 3',
            'image' => 'test.jpg',
            'sort_order' => 3,
        ]);
    }
}
