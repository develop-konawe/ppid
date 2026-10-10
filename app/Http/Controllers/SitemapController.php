<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Page;

class SitemapController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        $announcements = Announcement::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $pages = Page::all();

        return response()->view('sitemap', [
            'news' => $news,
            'announcements' => $announcements,
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
}
