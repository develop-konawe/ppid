<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PortalBeritaService;

class AnnouncementController extends Controller
{
    public function index(Request $request, PortalBeritaService $beritaService)
    {
        $params = [
            'page'     => $request->input('page', 1),
            'per_page' => 10,
        ];

        if ($request->filled('search')) {
            $params['search'] = $request->input('search');
        }

        $result = $beritaService->getPengumuman($params);
        $pengumumans = $result['data'];
        $meta = $result['meta'];

        return view('pages.announcement.index', compact('pengumumans', 'meta'));
    }
}
