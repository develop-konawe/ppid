<?php

namespace App\Console\Commands;

use App\Models\Opd;
use App\Services\OrpegService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncOpdWithOrpegCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opd:sync 
                            {--dry-run : Menampilkan rencana perubahan tanpa menyimpan ke database} 
                            {--force : Menjalankan sinkronisasi tanpa konfirmasi interaktif}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi data master OPD dari API ORPEG Pemda Konawe ke database lokal';

    /**
     * Execute the console command.
     */
    public function handle(OrpegService $orpegService): int
    {
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->warn('🔍 Mode DRY-RUN diaktifkan: Tidak ada perubahan yang akan disimpan ke database.');
        }

        $this->info('📡 Menghubungi API ORPEG Konawe...');
        $units = $orpegService->getUnits();

        if (empty($units)) {
            $this->error('❌ Tidak ada data yang diterima dari API ORPEG atau koneksi gagal.');
            return self::FAILURE;
        }

        $total = count($units);
        $this->info("📥 Diterima {$total} unit perangkat daerah dari ORPEG.");

        $created = 0;
        $updated = 0;
        $tableRows = [];

        foreach ($units as $unit) {
            $idUnit = trim($unit['id_unit'] ?? '');
            $namaUnit = trim($unit['nama_unit'] ?? '');

            if (empty($idUnit) || empty($namaUnit)) {
                continue;
            }

            // 1. Cari berdasarkan id_unit ORPEG
            $opd = Opd::where('id_unit', $idUnit)->first();
            $action = 'MATCH_ID';

            // 2. Jika belum ada id_unit, cari berdasarkan nama (Smart Matching)
            if (!$opd) {
                $opd = $this->findMatchingOpdByName($namaUnit);
                if ($opd) {
                    $action = 'MATCH_NAME';
                }
            }

            $payload = [
                'id_unit' => $idUnit,
                'nama_opd' => $namaUnit,
                'tipe_unit' => $unit['tipe_unit'] ?? null,
                'keterangan' => $unit['keterangan'] ?? null,
                'latitude' => !empty($unit['latitude']) ? (float) $unit['latitude'] : null,
                'longitude' => !empty($unit['longitude']) ? (float) $unit['longitude'] : null,
                'file_dasar_hukum' => $unit['file_dasar_hukum'] ?? null,
            ];

            if ($opd) {
                $status = ($action === 'MATCH_NAME') 
                    ? "Tautkan ID ({$idUnit}) & Update" 
                    : 'Perbarui Data';

                if (!$isDryRun) {
                    $opd->update($payload);
                }
                $updated++;
            } else {
                $status = 'Unit Baru (Create)';
                if (!$isDryRun) {
                    Opd::create($payload);
                }
                $created++;
            }

            $coord = (!empty($unit['latitude']) && !empty($unit['longitude']))
                ? "{$unit['latitude']}, {$unit['longitude']}"
                : '-';

            $tableRows[] = [
                $idUnit,
                $namaUnit,
                $unit['tipe_unit'] ?? '-',
                $coord,
                $status,
            ];
        }

        $this->table(
            ['ID Unit', 'Nama Perangkat Daerah', 'Tipe', 'Koordinat', 'Status Aksi'],
            $tableRows
        );

        $this->newLine();
        if ($isDryRun) {
            $this->info("Simulasi selesai. Rencana: {$updated} data diperbarui/ditautkan, {$created} unit baru akan dibuat.");
        } else {
            $this->info("✅ Sinkronisasi sukses! {$updated} data diperbarui/ditautkan, {$created} unit baru berhasil ditambahkan.");
        }

        return self::SUCCESS;
    }

    /**
     * Mencari kecocokan OPD lokal berdasarkan nama dengan toleransi case, alias, & variasi penulisan.
     * Hanya mencocokkan record yang BELUM memiliki id_unit agar tidak saling menimpa.
     */
    protected function findMatchingOpdByName(string $namaUnit): ?Opd
    {
        $normalizedInput = $this->normalizeString($namaUnit);

        // 1. Alias mapping untuk perbedaan istilah umum atau typo dari sumber ORPEG
        $aliases = [
            'dinas kependudukan dan pencatatan sipil' => 'dinas administrasi kependudukan dan pencatatan sipil',
            'dinas tanaman pengan, hortikultura dan perkebunan' => 'dinas tanaman pangan, hortikultura dan perkebunan',
            'dinas koperasi dan usaha kecil menengah' => 'dinas koperasi dan ukm',
            'dinas kepemudaan dan olah raga' => 'dinas kepemudaan dan olahraga',
            'badan kesatuan bangsa dan politik ( kesbangpol )' => 'badan kesatuan bangsa, politik dan perlindungan masyarakat',
            'badan kesatuan bangsa dan politik' => 'badan kesatuan bangsa, politik dan perlindungan masyarakat',
        ];

        if (isset($aliases[$normalizedInput])) {
            $matchedByAlias = Opd::whereNull('id_unit')
                ->whereRaw('LOWER(TRIM(nama_opd)) = ?', [$aliases[$normalizedInput]])
                ->first();
            if ($matchedByAlias) {
                return $matchedByAlias;
            }
        }

        // 2. Pencocokan eksak lowercase pada record yang belum ber-ID
        $exact = Opd::whereNull('id_unit')
            ->whereRaw('LOWER(TRIM(nama_opd)) = ?', [$normalizedInput])
            ->first();
        if ($exact) {
            return $exact;
        }

        // 3. Pencocokan jika hanya selisih kata 'daerah' (misal: "Inspektorat" vs "Inspektorat Daerah")
        $strippedInput = preg_replace('/\bdaerah\b/i', '', $normalizedInput);
        $strippedInput = preg_replace('/\s+/', ' ', trim($strippedInput));

        $unlinkedOpds = Opd::whereNull('id_unit')->get();
        foreach ($unlinkedOpds as $opd) {
            $normalizedDb = $this->normalizeString($opd->nama_opd);
            $strippedDb = preg_replace('/\bdaerah\b/i', '', $normalizedDb);
            $strippedDb = preg_replace('/\s+/', ' ', trim($strippedDb));

            if ($strippedDb === $strippedInput) {
                return $opd;
            }

            // Cek kesamaan singkatan jika ada
            if ($opd->singkatan && strtolower(trim($opd->singkatan)) === $normalizedInput) {
                return $opd;
            }
        }

        return null;
    }

    /**
     * Normalisasi string untuk pencocokan toleran.
     */
    protected function normalizeString(string $value): string
    {
        $clean = strtolower(trim($value));
        $clean = preg_replace('/\s+/', ' ', $clean);
        return $clean;
    }
}
