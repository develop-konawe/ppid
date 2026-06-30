<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Carousel;
use App\Models\Gallery;
use App\Models\PublicInformation;
use App\Models\InformationRequest;
use App\Models\Opd;
use App\Services\PortalBeritaService;

class HomeController extends Controller
{
    public function index(PortalBeritaService $beritaService)
    {
        // ambilkan data banner dengan status is_active = true dan urutkan berdasarkan sort_order
        $banners = Carousel::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        
        // Fetch Berita dari API (ambil 10 untuk memfilter is_pinned)
        $beritaResult = $beritaService->getBerita(['per_page' => 10]);
        $apiBeritas = collect($beritaResult['data']);

        // Fetch Pengumuman dari API (6 item terbaru)
        $pengumumanResult = $beritaService->getPengumuman(['per_page' => 6]);
        $apiPengumumans = collect($pengumumanResult['data']);

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
