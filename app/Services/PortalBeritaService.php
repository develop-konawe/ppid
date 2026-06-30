<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PortalBeritaService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.portal_berita.base_url');
        $this->apiKey = config('services.portal_berita.api_key');
    }

    /**
     * Send a GET request to the Portal Berita API.
     */
    protected function get(string $endpoint, array $params = [])
    {
        $params['api_key'] = $this->apiKey;

        return Http::timeout(10)->get($this->baseUrl . $endpoint, $params);
    }

    /**
     * Fetch Berita.
     */
    public function getBerita(array $params = [])
    {
        $response = $this->get('/berita', $params);

        $result = [
            'data' => collect(),
            'meta' => ['total' => 0, 'per_page' => $params['per_page'] ?? 10, 'current_page' => 1, 'last_page' => 1]
        ];

        if ($response->successful()) {
            $data = $response->json();
            
            $result['meta'] = $data['meta'] ?? $result['meta'];
            $result['data'] = collect($data['data'] ?? [])->map(function ($item) {
                return $this->mapItem($item, 'news');
            });
        }

        return $result;
    }

    /**
     * Fetch Pengumuman.
     */
    public function getPengumuman(array $params = [])
    {
        $response = $this->get('/pengumuman', $params);

        $result = [
            'data' => collect(),
            'meta' => ['total' => 0, 'per_page' => $params['per_page'] ?? 10, 'current_page' => 1, 'last_page' => 1]
        ];

        if ($response->successful()) {
            $data = $response->json();
            
            $result['meta'] = $data['meta'] ?? $result['meta'];
            $result['data'] = collect($data['data'] ?? [])->map(function ($item) {
                return $this->mapItem($item, 'announcement');
            });
        }

        return $result;
    }

    /**
     * Standardize the item structure.
     */
    protected function mapItem(array $item, string $type)
    {
        $obj = (object) $item;
        $obj->category = isset($item['category']) ? (object) $item['category'] : null;
        $obj->opd = isset($item['opd']) ? (object) $item['opd'] : null;
        $obj->created_at = isset($item['published_at']) && $item['published_at'] ? Carbon::parse($item['published_at']) : Carbon::now();
        $obj->published_at = $obj->created_at; // Alias for consistency
        $obj->description = $item['summary'] ?? '';
        $obj->content = $item['summary'] ?? '';
        $obj->image_url = $item['cover_image'] ?? $item['image'] ?? null;
        $obj->is_pinned = !empty($item['is_pinned']);
        $obj->views = $item['views'] ?? 0;
        $obj->url = $item['url'] ?? route($type);

        return $obj;
    }
}
