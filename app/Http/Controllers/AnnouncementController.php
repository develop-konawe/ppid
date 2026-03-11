<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category; // Pastikan model Category dipanggil
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query Dasar untuk List Pengumuman
        $query = Announcement::with('category')->where('is_active', true);

        // Filter berdasarkan Pencarian (Judul)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan Kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter berdasarkan Tahun Publikasi
        if ($request->filled('year')) {
            $query->whereYear('published_at', $request->year);
        }

        // Eksekusi Query dengan Pagination (hanya yang sudah lewat/sama dengan waktu sekarang)
        $pengumumans = $query->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        // 2. Ambil Pengumuman Penting / Highlight (Is Featured)
        $featured = Announcement::where('is_active', true)
            ->where('is_featured', true)
            ->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->first();

        // Jika tidak ada yang di-feature, ambil pengumuman terbaru biasa
        if (!$featured) {
            $featured = Announcement::where('is_active', true)
                ->whereDate('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->first();
        }

        // 3. Statistik Cepat
        $stats = [
            'total' => Announcement::count(),
            'tahun_ini' => Announcement::whereYear('published_at', now()->year)->count(),
            'aktif' => Announcement::where('is_active', true)->whereDate('published_at', '<=', now())->count(),
            'akan_datang' => Announcement::where('is_active', true)->whereDate('published_at', '>', now())->count(),
        ];

        // 4. Data Filter Dropdown & Kategori Grid Bawah
        $categories = Category::orderBy('name', 'asc')->get();

        $years = Announcement::selectRaw('YEAR(published_at) as year')
            ->whereNotNull('published_at')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view("pages.announcement.index", compact(
            'pengumumans', 'featured', 'stats', 'categories', 'years'
        ));
    }

    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)
            ->where('is_active', true)
            ->whereDate('published_at', '<=', now())->firstOrFail();

        $announcement->increment('views');

        $prev = Announcement::where('id', '<', $announcement->id)
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->first();

        $next = Announcement::where('id', '>', $announcement->id)
            ->where('is_active', true)
            ->orderBy('published_at', 'asc')
            ->first();

        return view('pages.announcement.detail', compact('announcement', 'prev', 'next'));
    }
}
