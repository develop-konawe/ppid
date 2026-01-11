<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\Statistik;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends \Filament\Pages\Dashboard
{
    public static function getNavigationIcon(): string | Htmlable | null
    {
        return static::$navigationIcon
            ?? FilamentIcon::resolve('panels::pages.dashboard.navigation-item')
            ?? (Filament::hasTopNavigation() ? 'heroicon-m-home' : 'heroicon-o-home');
    }

    public function getWidgets(): array
    {
        return [
            Statistik::class,
        ];
    }

}
