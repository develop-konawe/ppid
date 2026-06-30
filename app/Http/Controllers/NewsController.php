<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PortalBeritaService;

class NewsController extends Controller
{
    public function index(Request $request, PortalBeritaService $beritaService)
    {
        $params = [
            'page'     => $request->input('page', 1),
            'per_page' => 9,
        ];

        if ($request->filled('search')) {
            $params['search'] = $request->input('search');
        }

        if ($request->filled('category')) {
            $params['category'] = $request->input('category');
        }

        $result = $beritaService->getBerita($params);
        $beritas = $result['data'];
        $meta = $result['meta'];

        // Because the view loops over $berita['cover_image'], wait, earlier we mapped them to objects!
        // But the news/index.blade.php accesses them as arrays like $berita['cover_image'] ?
        // Let's modify news/index.blade.php as well, or convert the mapped object back to array here if needed.
        // Actually, let's keep it as an array to avoid breaking the view.
        // Wait, $beritas mapped by Service is objects. We need to pass them to view.
        
        return view('pages.news.index', compact('beritas', 'meta'));
    }
}
