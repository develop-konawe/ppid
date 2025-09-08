<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        // $pengumumans = Announcement::paginate(9);
        // tambahkan kondisi tanggal terbit dan active
        $pengumumans = Announcement::where('is_active', true)
            ->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view("pages.announcement.index", compact('pengumumans'));
    }

    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)->firstOrFail();

        $announcement->increment('views');

        // Ambil berita sebelumnya
        $prev = Announcement::where('id', '<', $announcement->id)
            ->orderBy('published_at', 'desc')
            ->first();

        // Ambil berita selanjutnya
        $next = Announcement::where('id', '>', $announcement->id)
            ->orderBy('published_at', 'asc')
            ->first();

        return view('pages.announcement.detail', compact('announcement', 'prev', 'next'));
    }
}
