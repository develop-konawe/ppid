<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnnouncementController extends Controller
{
    private const API_BASE_URL = 'https://berita.konawekab.go.id/api/v1';
    private const API_KEY = '418595a9a453178dbdc3ea13af01789324f967e9cd60069e624de8b92003a613';

    public function index(Request $request)
    {
        $params = [
            'api_key'  => self::API_KEY,
            'page'     => $request->input('page', 1),
            'per_page' => 10,
        ];

        if ($request->filled('search')) {
            $params['search'] = $request->input('search');
        }

        if ($request->filled('opd')) {
            $params['opd'] = $request->input('opd');
        }

        $response = Http::timeout(10)->get(self::API_BASE_URL . '/pengumuman', $params);

        $pengumumans = [];
        $meta        = ['total' => 0, 'per_page' => 10, 'current_page' => 1, 'last_page' => 1];

        if ($response->successful()) {
            $data        = $response->json();
            $pengumumans = $data['data'] ?? [];
            $meta        = $data['meta'] ?? $meta;
        }

        return view('pages.announcement.index', compact('pengumumans', 'meta'));
    }
}
