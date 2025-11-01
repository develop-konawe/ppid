<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RegulationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.detail');
Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
Route::get('/announcement/{slug}', [AnnouncementController::class, 'show'])->name('announcement.detail');
Route::get('/regulation', [RegulationController::class, 'index'])->name('regulation');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
