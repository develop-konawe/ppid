<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $page->increment('views');

        return view('pages.page.detail', compact('page'));
    }
}
