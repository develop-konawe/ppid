<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Carousel;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // ambilkan data banner dengan status is_active = true dan urutkan berdasarkan sort_order
        $banners = Carousel::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $beritas = News::where('is_featured', true)->get();
        $pengumumans = Announcement::where('is_featured', true)->get();// belum ada kolom is_featured di tabel announcements
        $latestBeritas = News::latest()->take(4)->get();
        $latestPengumuman = Announcement::latest()->take(2)->get();


        return view('pages.home.index', [
            "banners" => $banners,
            "beritas" => $beritas,
            "pengumumans" => $pengumumans,
            "latestBeritas" => $latestBeritas,
            "latestPengumuman" => $latestPengumuman
        ]);
    }
}
