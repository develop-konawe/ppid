<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrpegService
{
    protected string $baseUrl;
    protected ?string $username;
    protected ?string $password;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.orpeg.base_url', 'https://orpeg.konawekab.go.id/api/v1'), '/');
        $this->username = config('services.orpeg.username', 'kominfo');
        $this->password = config('services.orpeg.password', 'bersahaja2030');
    }

    /**
     * Mengambil seluruh daftar unit OPD dari API ORPEG.
     *
     * @return array
     */
    public function getUnits(): array
    {
        try {
            $response = Http::withBasicAuth($this->username, $this->password)
                ->timeout(15)
                ->retry(2, 500)
                ->get("{$this->baseUrl}/units");

            if ($response->successful()) {
                $payload = $response->json();
                return $payload['data'] ?? [];
            }

            Log::error('API ORPEG returned non-200 status', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal menghubungi API ORPEG: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return [];
    }

    /**
     * Uji koneksi ke endpoint API ORPEG.
     *
     * @return array ['success' => bool, 'message' => string, 'count' => int]
     */
    public function testConnection(): array
    {
        try {
            $response = Http::withBasicAuth($this->username, $this->password)
                ->timeout(10)
                ->get("{$this->baseUrl}/units");

            if ($response->successful()) {
                $data = $response->json('data') ?? [];
                return [
                    'success' => true,
                    'message' => 'Koneksi ke API ORPEG berhasil.',
                    'count' => count($data),
                ];
            }

            return [
                'success' => false,
                'message' => 'API ORPEG merespons dengan HTTP ' . $response->status(),
                'count' => 0,
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Gagal terkoneksi ke API ORPEG: ' . $e->getMessage(),
                'count' => 0,
            ];
        }
    }
}

