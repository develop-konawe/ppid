<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Page;
use App\Models\KlaProgram;

class SitemapController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        $announcements = Announcement::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $pages = Page::all();
        $klaPrograms = KlaProgram::where('is_active', true)->orderBy('created_at', 'desc')->get();

        return response()->view('sitemap', [
            'news' => $news,
            'announcements' => $announcements,
            'pages' => $pages,
            'klaPrograms' => $klaPrograms,
        ])->header('Content-Type', 'text/xml');
    }
}
