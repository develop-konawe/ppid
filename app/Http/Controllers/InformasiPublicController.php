<?php

namespace App\Http\Controllers;

use App\Models\InformationCategory;
use App\Models\Opd;
use App\Models\PublicInformation;
use Illuminate\Http\Request;

class InformasiPublicController extends Controller
{
    /**
     * Informasi Berkala dengan Filter
     */
    public function berkala(Request $request)
    {
        // Query dasar dengan relasi
        $query = PublicInformation::query()
            ->where('information_type', 'berkala')
            ->where('status', 'published')
            ->with(['opd', 'category']);

        // Filter pencarian (search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter tahun
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter OPD
        if ($request->filled('opd')) {
            $query->where('opd_id', $request->opd);
        }

        // Urutkan dan paginasi (dengan mempertahankan query string)
        $informations = $query->latest('published_at')
            ->paginate(10)
            ->withQueryString();

        // Data untuk keperluan filter dropdown
        $tahunList = PublicInformation::where('information_type', 'berkala')
            ->where('status', 'published')
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $kategoriList = InformationCategory::whereHas('publicInformations', function($q) {
            $q->where('information_type', 'berkala')
                ->where('status', 'published');
        })->get();

        $opdList = Opd::orderBy('nama_opd')->get();

        return view('pages.informasi-public.berkala', compact(
            'informations',
            'tahunList',
            'kategoriList',
            'opdList'
        ));
    }

    public function berkalaDetail(Request $request, $id)
    {
        // 1. Ambil data utama beserta relasi Kategori dan OPD
        $informasi = PublicInformation::with(['category', 'opd'])
            ->where('status', 'published')
            ->findOrFail($id);

        // 2. Ambil 3 dokumen terkait (kategori yang sama, tapi bukan dokumen yang sedang dibuka)
        $terkait = PublicInformation::with(['category', 'opd'])
            ->where('id', '!=', $informasi->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        // Tampilkan ke view (misalnya nama filenya detail-berkala.blade.php di dalam folder resources/views/informasi/)
        return view('pages.informasi-public.berkala-detail', compact('informasi', 'terkait'));
    }

    /**
     * Informasi Setiap Saat
     */
    public function setiapSaat(Request $request)
    {
        $data = PublicInformation::query()
            ->where('information_type', 'setiap_saat')
            ->where('status', 'published')
            ->with(['opd', 'category'])
            ->latest()
            ->paginate(10);

        return view('pages.informasi-public.setiap-saat', compact('data'));
    }

    /**
     * Informasi Serta Merta
     */
    public function sertaMerta(Request $request)
    {
        // 1. Query Dasar
        $query = PublicInformation::query()
            ->where('information_type', 'serta_merta')
            ->where('status', 'published')
            ->with(['opd', 'category']);

        // Filter Pencarian Text
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter Berdasarkan Kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Eksekusi Query untuk Tabel Paginasi
        $informations = $query->latest('published_at')
            ->paginate(10)
            ->withQueryString();

        // 2. Ambil 3 Data Terbaru untuk Kotak Peringatan (Alert Cards) di atas
        $latestAlerts = PublicInformation::with(['opd', 'category'])
            ->where('information_type', 'serta_merta')
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        // 3. Hitung Statistik (Total & Tahun Ini)
        $total = PublicInformation::where('information_type', 'serta_merta')
            ->where('status', 'published')
            ->count();

        $tahunIni = PublicInformation::where('information_type', 'serta_merta')
            ->where('status', 'published')
            ->whereYear('published_at', now()->year)
            ->count();

        $stats = [
            'total' => $total,
            'tahun_ini' => $tahunIni,
        ];

        // 4. Ambil Daftar Kategori untuk Dropdown Filter
        $categories = InformationCategory::whereHas('publicInformations', function($q) {
            $q->where('information_type', 'serta_merta')
                ->where('status', 'published');
        })->get();

        // Kirim semua variabel ke view
        return view('pages.informasi-public.serta-merta', compact(
            'informations',
            'latestAlerts',
            'stats',
            'categories'
        ));
    }

    /**
     * Informasi Dikecualikan
     */
    public function dikecualikan(Request $request)
    {
        // Mengambil data informasi dikecualikan beserta relasi kategori dan detail exception
        $informations = PublicInformation::with(['category', 'exception'])
            ->where('information_type', 'dikecualikan')
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(10);

        // Menghitung total statistik untuk bagian bawah (Ringkasan)
        $totalDikecualikan = PublicInformation::where('information_type', 'dikecualikan')
            ->where('status', 'published')
            ->count();

        $totalKategori = PublicInformation::where('information_type', 'dikecualikan')
            ->where('status', 'published')
            ->distinct('category_id')
            ->count();

        return view('pages.informasi-public.dikecualikan', compact('informations', 'totalDikecualikan', 'totalKategori'));
    }
}
