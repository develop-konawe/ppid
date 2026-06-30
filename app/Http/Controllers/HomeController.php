<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Carousel;
use App\Models\Gallery;
use App\Models\News;
use App\Models\PublicInformation;
use App\Models\InformationRequest;
use App\Models\Opd;

class HomeController extends Controller
{
    public function index()
    {
        // ambilkan data banner dengan status is_active = true dan urutkan berdasarkan sort_order
        $banners = Carousel::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        
        $apiKey = '418595a9a453178dbdc3ea13af01789324f967e9cd60069e624de8b92003a613';
        $apiBaseUrl = 'https://berita.konawekab.go.id/api/v1';

        // Fetch Berita dari API (ambil 10 untuk memfilter is_pinned)
        $respNews = \Illuminate\Support\Facades\Http::timeout(10)->get("$apiBaseUrl/berita", [
            'api_key' => $apiKey,
            'per_page' => 10
        ]);
        
        $apiBeritas = collect();
        if ($respNews->successful()) {
            $apiBeritas = collect($respNews->json('data') ?? [])->map(function($item) {
                $obj = (object)$item;
                $obj->category = isset($item['category']) ? (object)$item['category'] : null;
                $obj->created_at = isset($item['published_at']) && $item['published_at'] ? \Carbon\Carbon::parse($item['published_at']) : \Carbon\Carbon::now();
                $obj->description = $item['summary'] ?? '';
                $obj->content = $item['summary'] ?? '';
                $obj->image_url = $item['cover_image'] ?? $item['image'] ?? null;
                $obj->is_pinned = !empty($item['is_pinned']);
                $obj->url = $item['url'] ?? route('news');
                return $obj;
            });
        }

        // Fetch Pengumuman dari API (6 item terbaru)
        $respAnn = \Illuminate\Support\Facades\Http::timeout(10)->get("$apiBaseUrl/pengumuman", [
            'api_key' => $apiKey,
            'per_page' => 6
        ]);

        $apiPengumumans = collect();
        if ($respAnn->successful()) {
            $apiPengumumans = collect($respAnn->json('data') ?? [])->map(function($item) {
                $obj = (object)$item;
                $obj->category = isset($item['category']) ? (object)$item['category'] : null;
                $obj->published_at = isset($item['published_at']) && $item['published_at'] ? \Carbon\Carbon::parse($item['published_at']) : \Carbon\Carbon::now();
                $obj->description = $item['summary'] ?? '';
                $obj->image_url = $item['cover_image'] ?? $item['image'] ?? null;
                $obj->url = $item['url'] ?? route('announcement');
                return $obj;
            });
        }

        $beritas = $apiBeritas->filter(function($item) {
            return $item->is_pinned;
        })->take(4);

        if ($beritas->isEmpty()) {
            $beritas = $apiBeritas->take(4); // Fallback jika tidak ada yang di pin
        }

        $pengumumans = $apiPengumumans; // untuk papan pengumuman
        $latestBeritas = $apiBeritas->take(3); // untuk tab berita terbaru
        $latestPengumuman = $apiPengumumans->take(3); // untuk tab pengumuman terbaru

        // ambilkan data gallery terbaru sebanyak 9
        $gallery = Gallery::latest()->take(9)->get();

        // Bagian populer dihilangkan karena data berasal dari API
        $popularBeritas = collect();
        $popularPengumumans = collect();

        // ambil data akun sosial media
        $socialMedias = \App\Models\SocialMedia::where('is_active', true)->get();

        // Hitung statistik untuk Transparansi Dalam Angka
        $totalDokumen = PublicInformation::where('status', 'published')->count();
        $permohonanSelesai = InformationRequest::where('status', 'approved')->count();
        $totalOpd = Opd::count();
        
        $totalPermohonan = InformationRequest::count();
        $kepatuhanWaktu = $totalPermohonan > 0 ? round((InformationRequest::whereIn('status', ['approved', 'rejected'])->count() / $totalPermohonan) * 100) : 100;

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
            "totalDokumen" => $totalDokumen,
            "permohonanSelesai" => $permohonanSelesai,
            "totalOpd" => $totalOpd,
            "kepatuhanWaktu" => $kepatuhanWaktu,
        ]);
    }
}
