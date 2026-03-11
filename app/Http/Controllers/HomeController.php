<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Carousel;
use App\Models\Gallery;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // ambilkan data banner dengan status is_active = true dan urutkan berdasarkan sort_order
        $banners = Carousel::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $beritas = News::where('is_featured', true)->get();

        // ambilkan data pengumuman dengan status is_active = true dan is_featured = true
        $pengumumans = Announcement::where('is_active', true)
            ->get();//

        // ambilkan data 4 berita terbaru
        $latestBeritas = News::latest()->take(4)->get();

        // ambilkan data 2 pengumuman terbaru
        $latestPengumuman = Announcement::where('is_active', true)
            ->whereDate('published_at', '<=', now())
            ->latest()
            ->take(2)
            ->get();

        // ambilkan data gallery terbaru sebanyak 9
        $gallery = Gallery::latest()->take(9)->get();

        // ambilkan data 4 berita populer
        $popularBeritas = News::orderBy('views', 'desc')->take(4)->get();

        // ambilkan data 4 pengumuman populer
        $popularPengumumans = Announcement::where('is_active', true)
            ->whereDate('published_at', '<=', now())
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();

        // ambil data akun sosial media
        $socialMedias = \App\Models\SocialMedia::where('is_active', true)->get();

        return view('pages.home.index', [
            "banners" => $banners,
            "beritas" => $beritas,
            "pengumumans" => $pengumumans,
            "latestBeritas" => $latestBeritas,
            "latestPengumuman" => $latestPengumuman,
            "gallery" => $gallery,
            "popularBeritas" => $popularBeritas,
            "popularPengumumans" => $popularPengumumans,
            "socialMedias" => $socialMedias,
        ]);
    }
}
