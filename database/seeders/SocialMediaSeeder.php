<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialMedia::create([
            'id' => 1,
            'platform' => 'facebook',
            'url' => 'https://web.facebook.com/ppid.diskominfokonawe',
            'icon' => 'fa-facebook',
            'is_active' => true,
        ]);
        SocialMedia::create([
            'id' => 2,
            'platform' => 'tiktok',
            'url' => 'https://www.tiktok.com/@kominfokab.konawe',
            'icon' => 'fa-tiktok',
            'is_active' => true,
        ]);
        SocialMedia::create([
            'id' => 3,
            'platform' => 'instagram',
            'url' => 'https://www.instagram.com/ppid.konawe/',
            'icon' => 'fa-instagram',
            'is_active' => true,
        ]);
        SocialMedia::create([
            'id' => 4,
            'platform' => 'youtube',
            'url' => 'http://www.youtube.com/@diskominfokonawe8546',
            'icon' => 'fa-youtube',
            'is_active' => true,
        ]);
        SocialMedia::create([
            'id' => 5,
            'platform' => 'x',
            'url' => 'https://x.com',
            'icon' => 'fa-x-twitter',
            'is_active' => true,
        ]);
        SocialMedia::create([
            'id' => 6,
            'platform' => 'threads',
            'url' => 'https://www.threads.com',
            'icon' => 'fa-threads',
            'is_active' => true,
        ]);
    }
}
