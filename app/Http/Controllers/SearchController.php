<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Announcement;
use App\Models\PublicInformation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $kategori = $request->input('kategori');

        $semuaHasil = collect();

        if (!empty($keyword)) {

            // 1. PENCARIAN DI BERITA
            if (empty($kategori) || in_array($kategori, ['semua', 'berita'])) {
                $news = News::where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('content', 'LIKE', "%{$keyword}%")
                    ->latest()
                    ->get()
                    ->map(function ($item) {
                        return (object) [
                            'tipe'        => 'Berita',
                            'judul'       => $item->title,
                            'deskripsi'   => $item->content,
                            'tanggal'     => $item->created_at,
                            'url'         => route('news'),
                            'icon'        => 'fa-newspaper',
                            'badge_color' => 'bg-blue-100 text-blue-700 border-blue-200'
                        ];
                    });
                $semuaHasil = $semuaHasil->merge($news);
            }

            // 2. PENCARIAN DI PENGUMUMAN
            if (empty($kategori) || in_array($kategori, ['semua', 'pengumuman'])) {
                $announcements = Announcement::where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%")
                    ->latest()
                    ->get()
                    ->map(function ($item) {
                        return (object) [
                            'tipe'        => 'Pengumuman',
                            'judul'       => $item->title,
                            'deskripsi'   => $item->description,
                            'tanggal'     => $item->published_at ?? $item->created_at,
                            'url'         => route('announcement'),
                            'icon'        => 'fa-bullhorn',
                            'badge_color' => 'bg-amber-100 text-amber-700 border-amber-200'
                        ];
                    });
                $semuaHasil = $semuaHasil->merge($announcements);
            }

            // 3. PENCARIAN DI INFORMASI PUBLIK (DOKUMEN)
            $kategoriDokumen = ['dokumen', 'berkala', 'serta-merta', 'setiap-saat', 'semua'];

            if (empty($kategori) || in_array($kategori, $kategoriDokumen)) {

                // Pastikan HANYA dokumen yang statusnya 'published' yang bisa dicari publik
                $queryDokumen = PublicInformation::where('status', 'published')
                    ->where(function($q) use ($keyword) {
                        $q->where('title', 'LIKE', "%{$keyword}%")
                            ->orWhere('description', 'LIKE', "%{$keyword}%");
                    });

                // Filter berdasarkan jenis informasi
                if ($kategori === 'berkala') {
                    $queryDokumen->where('information_type', 'berkala');
                } elseif ($kategori === 'serta-merta') {
                    $queryDokumen->where('information_type', 'serta_merta');
                } elseif ($kategori === 'setiap-saat') {
                    $queryDokumen->where('information_type', 'setiap_saat');
                }

                $dokumens = $queryDokumen->latest('published_at')
                    ->get()
                    ->map(function ($item) {
                        // Label Jenis Informasi
                        $tipeLabel = 'Dokumen Publik';
                        if ($item->information_type === 'berkala') $tipeLabel = 'Informasi Berkala';
                        if ($item->information_type === 'serta_merta') $tipeLabel = 'Serta Merta';
                        if ($item->information_type === 'setiap_saat') $tipeLabel = 'Setiap Saat';
                        if ($item->information_type === 'dikecualikan') $tipeLabel = 'Dikecualikan';

                        // LOGIKA URL LAMPIRAN:
                        // Jika ada file lokal, arahkan ke storage. Jika URL eksternal, gunakan link tersebut.
                        $docUrl = '#';
                        $target = '_self'; // Buka di tab yang sama secara default

                        if (!empty($item->file_url)) {
                            $docUrl = $item->file_url;
                            $target = '_blank'; // Buka Google Drive/External link di tab baru
                        } elseif (!empty($item->file_path)) {
                            // Asumsikan symlink storage sudah dibuat: php artisan storage:link
                            $docUrl = asset('storage/' . $item->file_path);
                            $target = '_blank'; // Buka PDF lokal di tab baru
                        }

                        // Menggabungkan tahun (jika ada) ke dalam deskripsi agar lebih informatif
                        $deskripsiTampil = $item->description ?? 'Dokumen informasi publik Kabupaten Konawe.';
                        if (!empty($item->year)) {
                            $deskripsiTampil = "Tahun/Periode: " . $item->year . " - " . strip_tags($deskripsiTampil);
                        }

                        return (object) [
                            'tipe'        => $tipeLabel,
                            'judul'       => $item->title,
                            'deskripsi'   => $deskripsiTampil,
                            'tanggal'     => $item->published_at ?? $item->created_at,
                            'url'         => $docUrl,
                            'target'      => $target, // Atribut tambahan untuk buka di tab baru
                            'icon'        => 'fa-file-pdf',
                            'badge_color' => 'bg-green-100 text-green-700 border-green-200'
                        ];
                    });
                $semuaHasil = $semuaHasil->merge($dokumens);
            }

            // 4. Urutkan Gabungan Data Berdasarkan Tanggal Terbaru
            $semuaHasil = $semuaHasil->sortByDesc('tanggal');
        }

        // 5. Buat Manual Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageItems = $semuaHasil->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $results = new LengthAwarePaginator($currentPageItems, count($semuaHasil), $perPage, $currentPage, [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

        return view('pages.search.index', compact('keyword', 'kategori', 'results', 'semuaHasil'));
    }
}
