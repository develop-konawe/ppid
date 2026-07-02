<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ApiDocumentation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Dokumentasi API';
    protected static ?string $title = 'Dokumentasi API Integrasi';
    protected static ?string $navigationGroup = 'Layanan Publik';
    protected static ?int $navigationSort = 100;

    protected static string $view = 'filament.pages.api-documentation';

    public static function canAccess(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        if ($user->is_super_admin) {
            return true;
        }

        return $user->hasRole('operator_ppid');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }
}
