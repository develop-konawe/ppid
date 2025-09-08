<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $beritas = News::paginate(9);

        return view("pages.news.index", ["beritas" => $beritas]);
    }

    public function show($slug)
    {
        $berita = News::where('slug', $slug)->firstOrFail();

        $berita->increment('views');

        // Ambil berita sebelumnya
        $prev = News::where('id', '<', $berita->id)
            ->orderBy('id', 'desc')
            ->first();

        // Ambil berita selanjutnya
        $next = News::where('id', '>', $berita->id)
            ->orderBy('id', 'asc')
            ->first();

        return view("pages.news.detail", compact('berita', 'prev', 'next'));
    }
}
