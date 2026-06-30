<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    private const API_BASE_URL = 'https://berita.konawekab.go.id/api/v1';
    private const API_KEY = '418595a9a453178dbdc3ea13af01789324f967e9cd60069e624de8b92003a613';

    public function index(Request $request)
    {
        $params = [
            'api_key'  => self::API_KEY,
            'page'     => $request->input('page', 1),
            'per_page' => 9,
        ];

        if ($request->filled('search')) {
            $params['search'] = $request->input('search');
        }

        if ($request->filled('category')) {
            $params['category'] = $request->input('category');
        }

        $response = Http::timeout(10)->get(self::API_BASE_URL . '/berita', $params);

        $beritas   = [];
        $meta      = ['total' => 0, 'per_page' => 9, 'current_page' => 1, 'last_page' => 1];

        if ($response->successful()) {
            $data    = $response->json();
            $beritas = $data['data'] ?? [];
            $meta    = $data['meta'] ?? $meta;
        }

        return view('pages.news.index', compact('beritas', 'meta'));
    }
}
