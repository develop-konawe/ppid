<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $beritas = News::orderBy('created_at', 'desc')->paginate(6);

        // Mengambil data tambahan langsung di Blade karena Controller hanya mengirim $beritas
        $totalBerita = $beritas->total();
        $beritaBulanIni = \App\Models\News::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $kategoriCount = \App\Models\Category::count();
        $categories = \App\Models\Category::all();
        $popularNews = \App\Models\News::orderBy('views', 'desc')->limit(4)->get();
        $totalViews = \App\Models\News::sum('views');

        return view("pages.news.index", [
            "beritas" => $beritas,
            "totalBerita" => $totalBerita,
            "beritaBulanIni" => $beritaBulanIni,
            "kategoriCount" => $kategoriCount,
            "categories" => $categories,
            "popularNews" => $popularNews,
            "totalViews" => $totalViews,
        ]);
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
            // Addini26
        }

        // Jangan lupa tambahkan $relatedNews ke fungsi compact()
        return view("pages.news.detail", compact('berita', 'prev', 'next', 'relatedNews'));
    }
}
