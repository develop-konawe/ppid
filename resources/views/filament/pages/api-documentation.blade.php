<x-filament-panels::page>
    {{-- Flash Message for New Token --}}
    @if(session('new_api_token'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
            <div class="flex items-start gap-3">
                <x-filament::icon icon="heroicon-o-check-circle" class="h-5 w-5 flex-shrink-0 text-green-600 dark:text-green-400" />
                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-green-800 dark:text-green-200">
                        API Key Baru Berhasil Digenerate!
                    </h3>
                    <p class="mt-1 text-sm text-green-700 dark:text-green-300">
                        Salin dan simpan API Key berikut di tempat yang aman. Key ini hanya ditampilkan sekali dan tidak dapat dilihat kembali.
                    </p>
                    <div class="mt-3 flex items-center gap-2">
                        <input
                            type="text"
                            readonly
                            value="{{ session('new_api_token') }}"
                            id="new-token-display"
                            class="flex-1 rounded-lg border-green-300 bg-white px-3 py-2 text-sm font-mono dark:border-green-700 dark:bg-gray-800"
                        />
                        <button
                            onclick="navigator.clipboard.writeText(document.getElementById('new-token-display').value)"
                            class="rounded-lg bg-green-600 px-3 py-2 text-sm text-white hover:bg-green-700"
                        >
                            Salin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- API Key Section --}}
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-key" class="h-5 w-5 text-primary-500" />
                <span>API Key</span>
            </div>
        </x-slot>

        <div class="space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                API Key digunakan untuk mengakses endpoint API publik. Simpan API Key di tempat yang aman karena tidak dapat dilihat kembali setelah digenerate.
            </p>

            @php
                $user = auth()->user();
                $tokens = $user->tokens;
                $activeToken = $tokens->first();
            @endphp

            @if($activeToken && !session('new_api_token'))
                <div class="flex items-center gap-2">
                    <input
                        type="text"
                        readonly
                        value="{{ $activeToken->id }}.{{ substr($activeToken->token, 0, 20) }}..."
                        class="flex-1 rounded-lg border-gray-300 bg-gray-50 px-3 py-2 text-sm font-mono dark:border-gray-600 dark:bg-gray-700"
                    />
                    <button
                        onclick="navigator.clipboard.writeText('{{ $activeToken->id }}.{{ $activeToken->token }}')"
                        class="rounded-lg bg-primary-500 px-3 py-2 text-sm text-white hover:bg-primary-600"
                    >
                        Salin
                    </button>
                </div>
                <p class="text-xs text-gray-500">
                    Token ID: <code class="text-primary-600">{{ $activeToken->id }}</code>
                    | Dibuat: {{ $activeToken->created_at->format('d M Y H:i') }}
                </p>
            @elseif(!session('new_api_token'))
                <div class="rounded-lg bg-yellow-50 p-4 dark:bg-yellow-900/20">
                    <p class="text-sm text-yellow-800 dark:text-yellow-200">
                        Belum ada API Key yang aktif. Silakan generate API Key baru.
                    </p>
                </div>
            @endif

            <form
                action="{{ route('filament.admin.pages.api-documentation.generate-token') }}"
                method="POST"
                onsubmit="return confirm('Generate API Key baru akan mencabut API Key yang lama. Lanjutkan?')"
            >
                @csrf
                <x-filament::button type="submit" color="primary">
                    <x-filament::icon icon="heroicon-o-plus" class="mr-1 h-4 w-4" />
                    Generate API Key Baru
                </x-filament::button>
            </form>
        </div>
    </x-filament::section>

    {{-- Base URL Section --}}
    <x-filament::section class="mt-6">
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-globe-alt" class="h-5 w-5 text-primary-500" />
                <span>Base URL</span>
            </div>
        </x-slot>

        <div class="rounded-lg bg-gray-100 p-4 dark:bg-gray-800">
            <code class="text-sm font-mono text-primary-600 dark:text-primary-400">
                {{ url('/api/v1') }}
            </code>
        </div>

        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Semua endpoint API menggunakan base URL di atas. Tambahkan <code class="text-xs bg-gray-200 px-1 rounded dark:bg-gray-700">api_key</code> sebagai query parameter atau header <code class="text-xs bg-gray-200 px-1 rounded dark:bg-gray-700">X-API-Key</code> untuk autentikasi.
        </p>
    </x-filament::section>

    {{-- API Endpoints --}}
    <div class="mt-6 space-y-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            <x-filament::icon icon="heroicon-o-code-bracket" class="mr-2 inline h-5 w-5" />
            Referensi Endpoint API
        </h2>

        {{-- GET /api/v1/public-informations --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="rounded bg-green-500 px-2 py-1 text-xs font-bold text-white">GET</span>
                        <code class="text-sm font-mono">/api/v1/public-informations</code>
                    </div>
                    <span class="text-xs text-gray-500">Daftar Informasi Publik</span>
                </div>
            </x-slot>

            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Mengembalikan daftar informasi publik yang dipublikasikan, dengan paginasi dan filter opsional.
            </p>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-2 text-left font-semibold">Parameter</th>
                        <th class="px-4 py-2 text-left font-semibold">Tipe</th>
                        <th class="px-4 py-2 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">api_key</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">API Key (via header <code>X-API-Key</code> atau query string)</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">per_page</td>
                        <td class="px-4 py-2">integer</td>
                        <td class="px-4 py-2">Jumlah item per halaman (default: 10, maks: 50)</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">category_id</td>
                        <td class="px-4 py-2">integer</td>
                        <td class="px-4 py-2">Filter berdasarkan ID kategori</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">year</td>
                        <td class="px-4 py-2">integer</td>
                        <td class="px-4 py-2">Filter berdasarkan tahun</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-xs">search</td>
                        <td class="px-4 py-2">string</td>
                        <td class="px-4 py-2">Kata kunci pencarian judul/konten</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Request:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-green-400"><code>{{ url('/api/v1/public-informations') }}?api_key=YOUR_API_KEY&per_page=10</code></pre>
            </div>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Response:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-gray-300"><code>{
  "status": "success",
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "title": "Judul Informasi",
        "content": "Konten informasi...",
        "category": { "id": 1, "nama_kategori": "Regulasi" },
        "opd": { "id": 1, "nama_opd": "Dinas Contoh" },
        "published_at": "2026-01-01T00:00:00.000000Z"
      }
    ],
    "total": 100,
    "per_page": 10,
    "last_page": 10
  }
}</code></pre>
            </div>
        </x-filament::section>

        {{-- GET /api/v1/public-informations/{id} --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="rounded bg-green-500 px-2 py-1 text-xs font-bold text-white">GET</span>
                        <code class="text-sm font-mono">/api/v1/public-informations/{id}</code>
                    </div>
                    <span class="text-xs text-gray-500">Detail Informasi Publik</span>
                </div>
            </x-slot>

            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Mengembalikan detail lengkap satu informasi publik berdasarkan ID.
            </p>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-2 text-left font-semibold">Parameter</th>
                        <th class="px-4 py-2 text-left font-semibold">Tipe</th>
                        <th class="px-4 py-2 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">api_key</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">API Key (via header <code>X-API-Key</code> atau query string)</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-xs">id</td>
                        <td class="px-4 py-2"><span class="text-red-500">integer*</span></td>
                        <td class="px-4 py-2">ID informasi publik (path parameter)</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Request:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-green-400"><code>{{ url('/api/v1/public-informations/1') }}?api_key=YOUR_API_KEY</code></pre>
            </div>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Response:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-gray-300"><code>{
  "status": "success",
  "data": {
    "id": 1,
    "title": "Judul Informasi",
    "content": "Konten lengkap informasi...",
    "category": { "id": 1, "nama_kategori": "Regulasi" },
    "opd": { "id": 1, "nama_opd": "Dinas Contoh" },
    "published_at": "2026-01-01T00:00:00.000000Z"
  }
}</code></pre>
            </div>
        </x-filament::section>

        {{-- GET /api/v1/statistics --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="rounded bg-green-500 px-2 py-1 text-xs font-bold text-white">GET</span>
                        <code class="text-sm font-mono">/api/v1/statistics</code>
                    </div>
                    <span class="text-xs text-gray-500">Statistik PPID</span>
                </div>
            </x-slot>

            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Mengembalikan ringkasan statistik PPID termasuk jumlah informasi publik dan permohonan informasi.
            </p>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-2 text-left font-semibold">Parameter</th>
                        <th class="px-4 py-2 text-left font-semibold">Tipe</th>
                        <th class="px-4 py-2 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-mono text-xs">api_key</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">API Key (via header <code>X-API-Key</code> atau query string)</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Request:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-green-400"><code>{{ url('/api/v1/statistics') }}?api_key=YOUR_API_KEY</code></pre>
            </div>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Response:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-gray-300"><code>{
  "status": "success",
  "data": {
    "total_public_information": 150,
    "requests": {
      "total": 45,
      "pending": 5,
      "approved": 35,
      "rejected": 5
    }
  }
}</code></pre>
            </div>
        </x-filament::section>

        {{-- POST /api/v1/information-requests --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="rounded bg-blue-500 px-2 py-1 text-xs font-bold text-white">POST</span>
                        <code class="text-sm font-mono">/api/v1/information-requests</code>
                    </div>
                    <span class="text-xs text-gray-500">Ajukan Permohonan Informasi</span>
                </div>
            </x-slot>

            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Mengajukan permohonan informasi publik baru. Endpoint ini dapat diakses oleh publik.
            </p>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-2 text-left font-semibold">Parameter</th>
                        <th class="px-4 py-2 text-left font-semibold">Tipe</th>
                        <th class="px-4 py-2 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">api_key</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">API Key (via header <code>X-API-Key</code> atau query string)</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">kategori_pemohon</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Kategori pemohon (contoh: Perorangan, Organisasi, Badan Hukum)</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">nik_no_identitas</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">NIK atau nomor identitas pemohon</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">nama_lengkap</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Nama lengkap pemohon</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">alamat</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Alamat lengkap pemohon</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">email</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Alamat email pemohon</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">no_telp</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Nomor telepon pemohon</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">pekerjaan</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Pekerjaan pemohon</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">rincian_informasi</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Rincian informasi yang diminta</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">tujuan_penggunaan</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Tujuan penggunaan informasi</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">cara_memperoleh</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Cara memperoleh informasi</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-xs">cara_mendapatkan</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">Cara mendapatkan informasi</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Request (cURL):</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-green-400"><code>curl -X POST {{ url('/api/v1/information-requests') }} \
  -H "X-API-Key: YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "kategori_pemohon": "Perorangan",
    "nik_no_identitas": "1234567890123456",
    "nama_lengkap": "John Doe",
    "alamat": "Jl. Contoh No. 123",
    "email": "john@example.com",
    "no_telp": "081234567890",
    "pekerjaan": "Karyawan",
    "rincian_informasi": "Data anggaran 2026",
    "tujuan_penggunaan": "Penelitian",
    "cara_memperoleh": "Softcopy",
    "cara_mendapatkan": "Email"
  }'</code></pre>
            </div>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Response:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-gray-300"><code>{
  "status": "success",
  "message": "Information request submitted successfully.",
  "data": {
    "id": 1,
    "nik_no_identitas": "1234567890123456"
  }
}</code></pre>
            </div>
        </x-filament::section>

        {{-- POST /api/v1/information-requests/check --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="rounded bg-blue-500 px-2 py-1 text-xs font-bold text-white">POST</span>
                        <code class="text-sm font-mono">/api/v1/information-requests/check</code>
                    </div>
                    <span class="text-xs text-gray-500">Cek Status Permohonan</span>
                </div>
            </x-slot>

            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Mengecek status permohonan informasi berdasarkan ID dan NIK pemohon.
            </p>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-2 text-left font-semibold">Parameter</th>
                        <th class="px-4 py-2 text-left font-semibold">Tipe</th>
                        <th class="px-4 py-2 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">api_key</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">API Key (via header <code>X-API-Key</code> atau query string)</td>
                    </tr>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="px-4 py-2 font-mono text-xs">id</td>
                        <td class="px-4 py-2"><span class="text-red-500">integer*</span></td>
                        <td class="px-4 py-2">ID permohonan informasi</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-xs">nik_no_identitas</td>
                        <td class="px-4 py-2"><span class="text-red-500">string*</span></td>
                        <td class="px-4 py-2">NIK pemohon untuk verifikasi</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Request (cURL):</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-green-400"><code>curl -X POST {{ url('/api/v1/information-requests/check') }} \
  -H "X-API-Key: YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "id": 1,
    "nik_no_identitas": "1234567890123456"
  }'</code></pre>
            </div>

            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold text-gray-700 dark:text-gray-300">Contoh Response:</p>
                <pre class="overflow-x-auto rounded-lg bg-gray-900 p-4 text-xs text-gray-300"><code>{
  "status": "success",
  "data": {
    "id": 1,
    "status": "approved",
    "response_message": "Permohonan disetujui",
    "response_file": "path/to/file.pdf",
    "responded_at": "2026-01-15T10:30:00.000000Z"
  }
}</code></pre>
            </div>
        </x-filament::section>
    </div>

    {{-- Authentication Section --}}
    <x-filament::section class="mt-6">
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-shield-check" class="h-5 w-5 text-primary-500" />
                <span>Autentikasi</span>
            </div>
        </x-slot>

        <div class="space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Semua endpoint API memerlukan autentikasi menggunakan API Key. API Key dapat dikirim melalui:
            </p>

            <ul class="list-disc space-y-2 pl-6 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <strong>Query Parameter:</strong> Tambahkan <code class="text-xs bg-gray-200 px-1 rounded dark:bg-gray-700">?api_key=YOUR_API_KEY</code> di akhir URL
                </li>
                <li>
                    <strong>Header:</strong> Tambahkan header <code class="text-xs bg-gray-200 px-1 rounded dark:bg-gray-700">X-API-Key: YOUR_API_KEY</code> pada setiap request
                </li>
            </ul>

            <div class="rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Catatan Keamanan:</strong> Simpan API Key di tempat yang aman. Jangan bagikan API Key kepada pihak yang tidak berkepentingan. Jika API Key bocor, segera generate API Key baru.
                </p>
            </div>
        </div>
    </x-filament::section>

    {{-- Error Codes Section --}}
    <x-filament::section class="mt-6">
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-exclamation-triangle" class="h-5 w-5 text-primary-500" />
                <span>Kode Error</span>
            </div>
        </x-slot>

        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th class="px-4 py-2 text-left font-semibold">Kode HTTP</th>
                    <th class="px-4 py-2 text-left font-semibold">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-4 py-2 font-mono text-xs">200</td>
                    <td class="px-4 py-2">Sukses</td>
                </tr>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-4 py-2 font-mono text-xs">201</td>
                    <td class="px-4 py-2">Resource berhasil dibuat</td>
                </tr>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-4 py-2 font-mono text-xs">401</td>
                    <td class="px-4 py-2">API Key tidak valid atau tidak diberikan</td>
                </tr>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-4 py-2 font-mono text-xs">404</td>
                    <td class="px-4 py-2">Resource tidak ditemukan</td>
                </tr>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-4 py-2 font-mono text-xs">422</td>
                    <td class="px-4 py-2">Validasi gagal (data tidak lengkap atau tidak valid)</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-mono text-xs">500</td>
                    <td class="px-4 py-2">Error server internal</td>
                </tr>
            </tbody>
        </table>
    </x-filament::section>
</x-filament-panels::page>
