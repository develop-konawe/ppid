<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Menu; // Pastikan Model Menu di-import
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $page->increment('views');

        // 1. Cari menu yang mengarah ke halaman ini
        $currentMenu = Menu::where('page_id', $page->id)->first();
        $relatedMenus = collect(); // Koleksi kosong sebagai default

        if ($currentMenu) {
            // 2. Jika ketemu, ambil menu lain yang memiliki parent_id yang sama (satu kelompok)
            $relatedMenus = Menu::with(['page', 'news', 'announcement']) // Eager load relasi untuk URL
            ->where('parent_id', $currentMenu->parent_id)
                ->where('id', '!=', $currentMenu->id) // Jangan tampilkan halaman ini sendiri
                ->orderBy('order', 'asc')
                ->take(6)
                ->get();
        }

        return view('pages.page.detail', compact('page', 'relatedMenus'));
    }
}
