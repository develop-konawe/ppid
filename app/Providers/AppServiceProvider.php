<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SocialMedia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pastikan nama bulan/hari dari Carbon tampil dalam Bahasa Indonesia
        Carbon::setLocale('id');

        // Share data social media ke seluruh view (footer, dsb.)
        View::composer('*', function ($view) {
            if (!isset($view->getData()['socialMedias'])) {
                $view->with('socialMedias', SocialMedia::where('is_active', true)->get());
            }
        });
    }
}
