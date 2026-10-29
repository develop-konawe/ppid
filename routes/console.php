<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jadwal otomatis sinkronisasi data master OPD dari API ORPEG setiap awal pekan
Schedule::command('opd:sync --force')->weeklyOn(1, '02:00');

