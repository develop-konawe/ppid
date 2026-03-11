<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $beritas = News::orderBy('created_at', 'desc')->paginate(9);
        return view("pages.news.index", ["beritas" => $beritas]);
    }

    public function show($slug)
    {
        $berita = News::where('slug', $slug)->firstOrFail();
        $berita->increment('views');

        $prev = News::where('id', '<', $berita->id)->orderBy('id', 'desc')->first();
        $next = News::where('id', '>', $berita->id)->orderBy('id', 'asc')->first();

        // --- TAMBAHKAN INI UNTUK BERITA TERKAIT ---
        // Cari 3 berita lain di kategori yang sama, kecualikan berita yang sedang dibaca
        $relatedNews = News::where('category_id', $berita->category_id)
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(3)
            ->get();

        // Jika tidak ada berita di kategori yang sama, ambil 3 berita terbaru secara umum
        if ($relatedNews->isEmpty()) {
            $relatedNews = News::where('id', '!=', $berita->id)
                ->latest()
                ->take(3)
                ->get();
        }

        // Jangan lupa tambahkan $relatedNews ke fungsi compact()
        return view("pages.news.detail", compact('berita', 'prev', 'next', 'relatedNews'));
    }
}
