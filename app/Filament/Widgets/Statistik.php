<?php

namespace App\Filament\Widgets;

use App\Models\Announcement;
use App\Models\News;
use App\Models\PublicInformation;
use App\Models\InformationRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Statistik extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Dokumen Publik', PublicInformation::where('status', 'published')->count())
                ->description('Informasi Publik Terbit')
                ->icon('heroicon-o-document-text'),
                
            Stat::make('Permohonan Informasi Masuk', InformationRequest::count())
                ->description('Total permohonan')
                ->icon('heroicon-o-document-magnifying-glass'),

            Stat::make('Permohonan Menunggu', InformationRequest::whereIn('status', ['pending', 'diproses'])->count())
                ->description('Belum ditanggapi final')
                ->icon('heroicon-o-clock')
                ->color('warning'),
                
            Stat::make('Total Berita', News::count())
                ->description('Jumlah seluruh berita')
                ->icon('heroicon-o-newspaper'),
                
            Stat::make('Total Views Berita', News::sum('views'))
                ->description('Jumlah total pembaca')
                ->icon('heroicon-o-eye'),

            Stat::make('Total Pengumuman', Announcement::count())
                ->description('Jumlah seluruh pengumuman')
                ->icon('heroicon-o-megaphone'),
        ];
    }
}
