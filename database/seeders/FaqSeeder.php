<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'question' => 'Bagaimana cara mengajukan permohonan informasi?',
                'answer' => 'Anda dapat mengisi formulir online di menu Layanan atau datang langsung ke kantor.',
                'sort_order' => 1,
            ],
        ]);

    }
}
