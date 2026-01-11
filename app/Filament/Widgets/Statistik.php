<?php

namespace App\Filament\Widgets;

use App\Models\Announcement;
use App\Models\News;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Statistik extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengumuman', Announcement::count())
                ->description('Jumlah seluruh pengumuman')
                ->icon('heroicon-o-megaphone'),

            Stat::make('Pengumuman Aktif', Announcement::where('is_active', true)->count())
                ->description('Pengumuman yang sedang aktif')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Total Berita', News::count())
                ->description('Jumlah seluruh berita')
                ->icon('heroicon-o-newspaper'),

            Stat::make('Berita Unggulan', News::where('is_featured', true)->count())
                ->description('Berita yang ditandai unggulan')
                ->icon('heroicon-o-star'),

            Stat::make('Total Views Berita', News::sum('views'))
                ->description('Jumlah total pembaca berita')
                ->icon('heroicon-o-eye'),

            Stat::make('PPID Utama', News::where('source_type', 'ppid_utama')->count())
                ->description('Berita dari PPID Utama')
                ->icon('heroicon-o-building-office'),

            Stat::make('PPID Pelaksana', News::where('source_type', 'ppid_pelaksana')->count())
                ->description('Berita dari PPID Pelaksana')
                ->icon('heroicon-o-building-library'),
        ];
    }
}
