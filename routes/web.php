<?php

use App\Http\Controllers\InformasiPublicController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\KlaController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PpidPelaksanaController;
use App\Http\Controllers\FaqController;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
Route::get('/regulation', [RegulationController::class, 'index'])->name('regulation');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.detail');

// KLA - Kabupaten/Kota Layak Anak
Route::get('/kla', [KlaController::class, 'index'])->name('kla');
Route::get('/kla/publikasi/{slug}', [KlaController::class, 'showProgram'])->name('kla.program.detail');
Route::post('/kla/pengaduan', [KlaController::class, 'submitComplaint'])->name('kla.complaint.store');

// PPID Pelaksana
Route::get('/ppid-pelaksana', [PpidPelaksanaController::class, 'index'])->name('ppid.pelaksana');

Route::get('/search', [SearchController::class, 'index'])->name('search.global');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::get('/informasi-berkala', [InformasiPublicController::class, 'berkala'])
    ->name('ppid.berkala');

Route::get('/informasi-berkala/{id}', [InformasiPublicController::class, 'berkalaDetail'])
    ->name('berkala.detail');

Route::get('/informasi-setiap-saat', [InformasiPublicController::class, 'setiapSaat'])
    ->name('ppid.setiap-saat');

Route::get('/informasi-setiap-saat/{id}', [InformasiPublicController::class, 'setiapSaatDetail'])
    ->name('setiap-saat.detail');

Route::get('/informasi-serta-merta', [InformasiPublicController::class, 'sertaMerta'])
    ->name('ppid.serta-merta');

Route::get('/informasi-serta-merta/{id}', [InformasiPublicController::class, 'sertaMertaDetail'])
    ->name('serta-merta.detail');

Route::get('/informasi-dikecualikan', [InformasiPublicController::class, 'dikecualikan'])
    ->name('ppid.dikecualikan');

// Permohonan Informasi Publik
Route::get('/permohonan-informasi', [InformationRequestController::class, 'index'])->name('permohonan.index');
Route::post('/permohonan-informasi', [InformationRequestController::class, 'store'])->name('permohonan.store');

// Cetak permohonan – hanya untuk user yang sudah login (admin/petugas)
Route::middleware('auth')->get('/permohonan/{informationRequest}/cetak', [InformationRequestController::class, 'printPdf'])->name('permohonan.print');

// Cek Status Permohonan
Route::get('/cek-status', [InformationRequestController::class, 'checkStatus'])->name('permohonan.status');
Route::post('/cek-status', [InformationRequestController::class, 'processCheckStatus'])->name('permohonan.status.check');

// API Documentation - Generate Token
Route::middleware(['auth'])->post('/admin/api-documentation/generate-token', function () {
    $user = auth()->user();

    if (! $user->is_super_admin && ! $user->hasRole('operator_ppid')) {
        abort(403, 'Unauthorized');
    }

    // Revoke existing tokens
    $user->tokens()->delete();

    // Create new token
    $token = $user->createToken('api-token');

    return redirect()->route('filament.admin.pages.api-documentation')
        ->with('new_api_token', $token->plainTextToken);
})->name('filament.admin.pages.api-documentation.generate-token');

// Temporary route to run specific migration
Route::get('/run-migration/{filename}', function ($filename) {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', [
            '--path' => 'database/migrations/' . $filename . '.php',
            '--force' => true
        ]);
        return "Migration {$filename} executed successfully. Output: <br><pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "Error executing migration: " . $e->getMessage();
    }
});

// Temporary route to run specific seeder
// Route::get('/run-seeder/{classname}', function ($classname) {
//     try {
//         \Illuminate\Support\Facades\Artisan::call('db:seed', [
//             '--class' => $classname,
//             '--force' => true
//         ]);
//         return "Seeder {$classname} executed successfully. Output: <br><pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
//     } catch (\Exception $e) {
//         return "Error executing seeder: " . $e->getMessage();
//     }
// });
