<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permohonan Informasi Publik – #{{ str_pad($permohonan->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* Paksa browser mempertahankan warna background & gambar saat print */
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            color: #1a1a1a;
            background: #fff;
            padding: 0;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 15mm 18mm;
            background: #fff;
        }

        /* ── Header ── */
        .header {
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 3px solid #1a3a6b;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }
        .header-logo img {
            width: 72px;
            height: 72px;
            object-fit: contain;
        }
        .header-text { flex: 1; text-align: center; }
        .header-text .instansi {
            font-size: 10pt;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header-text .doc-title {
            font-size: 14pt;
            font-weight: bold;
            color: #1a3a6b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .header-text .sub-title {
            font-size: 9pt;
            color: #777;
            margin-top: 2px;
        }
        .header-nomor {
            text-align: right;
            font-size: 9pt;
            color: #555;
            min-width: 120px;
        }
        .header-nomor .nomor-val {
            font-weight: bold;
            font-size: 11pt;
            color: #1a3a6b;
        }

        /* ── Section Titles ── */
        .section-title {
            font-size: 10pt;
            font-weight: bold;
            color: #fff;
            background: #1a3a6b;
            padding: 4px 10px;
            margin: 12px 0 6px;
            letter-spacing: 0.5px;
        }

        /* ── Data Table ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5pt;
        }
        .data-table tr td {
            padding: 4px 6px;
            vertical-align: top;
            border: 1px solid #d0d8e8;
        }
        .data-table tr td:first-child {
            width: 38%;
            background: #f0f4fb;
            font-weight: 600;
            color: #1a3a6b;
        }
        .data-table tr td:nth-child(2) {
            width: 2%;
            background: #f0f4fb;
            text-align: center;
            color: #555;
        }
        .data-table tr td:nth-child(3) {
            width: 60%;
        }

        /* ── Status Badge ── */
        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10pt;
        }
        .status-pending  { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
        .status-diproses { background: #cff4fc; color: #055160; border: 1px solid #0dcaf0; }
        .status-approved { background: #d1e7dd; color: #0f5132; border: 1px solid #198754; }
        .status-rejected { background: #f8d7da; color: #842029; border: 1px solid #dc3545; }

        /* ── Response Box ── */
        .response-box {
            border: 1px solid #d0d8e8;
            border-left: 4px solid #1a3a6b;
            padding: 8px 12px;
            margin-top: 6px;
            background: #f8faff;
            font-size: 10.5pt;
            line-height: 1.6;
        }

        /* ── Foto Identitas ── */
        .foto-identitas-wrapper {
            margin-top: 8px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }
        .foto-identitas-box {
            border: 1px solid #d0d8e8;
            border-radius: 4px;
            overflow: hidden;
            background: #f0f4fb;
            flex-shrink: 0;
        }
        .foto-identitas-box img {
            display: block;
            max-width: 220px;
            max-height: 160px;
            object-fit: contain;
            width: 220px;
            height: 160px;
        }
        .foto-identitas-label {
            font-size: 8.5pt;
            color: #555;
            text-align: center;
            padding: 4px;
            background: #f0f4fb;
            border-top: 1px solid #d0d8e8;
        }

        /* ── Footer cetak ── */
        .footer-print {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 8px;
            font-size: 8.5pt;
            color: #888;
            line-height: 1.6;
        }

        /* ── Print media ── */
        @media print {
            html, body { height: 100%; margin: 0; padding: 0; }
            .page { margin: 0; padding: 15mm 18mm; box-shadow: none; }
            .no-print { display: none !important; }
            @page { size: A4; margin: 0; }
        }

        /* ── Screen preview toolbar ── */
        .toolbar {
            position: fixed;
            top: 16px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 999;
        }
        .btn-print, .btn-close {
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            font-size: 12pt;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }
        .btn-print { background: #1a3a6b; color: #fff; }
        .btn-print:hover { background: #12285a; }
        .btn-close { background: #6c757d; color: #fff; }
        .btn-close:hover { background: #545b62; }

        @media screen {
            body { background: #e0e6ef; }
            .page {
                box-shadow: 0 4px 24px rgba(0,0,0,0.15);
                margin: 60px auto 40px;
            }
        }
    </style>
</head>
<body>

{{-- Toolbar hanya muncul di layar, tidak saat print --}}
<div class="toolbar no-print">
    <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
    <button class="btn-close" onclick="window.close()">✕ Tutup</button>
</div>

<div class="page">

    {{-- ── HEADER ── --}}
    <div class="header">
        <div class="header-logo">
            <img src="{{ asset('image/logo_konawe.png') }}" alt="Logo Konawe">
        </div>
        <div class="header-text">
            <div class="instansi">Pejabat Pengelola Informasi dan Dokumentasi (PPID)</div>
            <div class="doc-title">Formulir Permohonan Informasi Publik</div>
            <div class="sub-title">Kabupaten Konawe, Sulawesi Tenggara</div>
        </div>
        <div class="header-nomor">
            <div>No. Registrasi</div>
            <div class="nomor-val">{{ str_pad($permohonan->id, 5, '0', STR_PAD_LEFT) }}</div>
            <div style="margin-top:4px; font-size:8.5pt;">
                {{ \Carbon\Carbon::parse($permohonan->created_at)->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    {{-- ── STATUS PERMOHONAN ── --}}
    <div style="text-align:right; margin-bottom: 8px;">
        @php
            $statusLabel = match($permohonan->status) {
                'pending'  => 'Menunggu Proses',
                'diproses' => 'Sedang Diproses',
                'approved' => 'Disetujui',
                'rejected' => 'Ditolak',
                default    => ucfirst($permohonan->status),
            };
            $statusClass = 'status-' . $permohonan->status;
        @endphp
        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
    </div>

    {{-- ── IDENTITAS PEMOHON ── --}}
    <div class="section-title">A. Identitas Pemohon</div>
    <table class="data-table">
        <tr>
            <td>Kategori Pemohon</td><td>:</td>
            <td>{{ $permohonan->kategori_pemohon }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td><td>:</td>
            <td>{{ $permohonan->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>NIK / No. Identitas</td><td>:</td>
            <td>{{ $permohonan->nik_no_identitas ?? '-' }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td><td>:</td>
            <td>{{ $permohonan->pekerjaan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Alamat</td><td>:</td>
            <td>{{ $permohonan->alamat }}</td>
        </tr>
        <tr>
            <td>Email</td><td>:</td>
            <td>{{ $permohonan->email }}</td>
        </tr>
        <tr>
            <td>No. Telepon / WA</td><td>:</td>
            <td>{{ $permohonan->no_telp }}</td>
        </tr>
    </table>

    {{-- ── FOTO IDENTITAS ── --}}
    @if($permohonan->foto_ktp)
    <div class="section-title">B. Foto Identitas (KTP / Kartu Identitas)</div>
    <div class="foto-identitas-wrapper">
        <div>
            <div class="foto-identitas-box">
                <img src="{{ asset('storage/' . $permohonan->foto_ktp) }}"
                     alt="Foto Identitas {{ $permohonan->nama_lengkap }}">
            </div>
            <div class="foto-identitas-label">KTP / Identitas Pemohon</div>
        </div>
        <div style="font-size:9pt; color:#555; line-height:1.7; padding-top:4px;">
            <p>Identitas atas nama:</p>
            <p><strong>{{ $permohonan->nama_lengkap }}</strong></p>
            <p>NIK: {{ $permohonan->nik_no_identitas ?? '-' }}</p>
            <p style="margin-top:8px; color:#888; font-size:8.5pt;">
                Foto identitas ini diunggah sendiri oleh pemohon pada saat pengajuan permohonan.
            </p>
        </div>
    </div>
    @endif

    {{-- ── RINCIAN PERMOHONAN ── --}}
    <div class="section-title">{{ $permohonan->foto_ktp ? 'C' : 'B' }}. Rincian Permohonan Informasi</div>
    <table class="data-table">
        <tr>
            <td>Rincian Informasi yang Diminta</td><td>:</td>
            <td>{{ $permohonan->rincian_informasi }}</td>
        </tr>
        <tr>
            <td>Tujuan Penggunaan Informasi</td><td>:</td>
            <td>{{ $permohonan->tujuan_penggunaan }}</td>
        </tr>
        <tr>
            <td>Cara Memperoleh Informasi</td><td>:</td>
            <td>{{ $permohonan->cara_memperoleh }}</td>
        </tr>
        <tr>
            <td>Cara Mendapatkan Salinan</td><td>:</td>
            <td>{{ $permohonan->cara_mendapatkan }}</td>
        </tr>
        @if($permohonan->information)
        <tr>
            <td>Informasi Terkait</td><td>:</td>
            <td>{{ $permohonan->information->title ?? '-' }}</td>
        </tr>
        @endif
        <tr>
            <td>Tanggal Permohonan</td><td>:</td>
            <td>{{ \Carbon\Carbon::parse($permohonan->created_at)->translatedFormat('d F Y, H:i') }} WIB</td>
        </tr>
    </table>

    {{-- ── TANGGAPAN PPID ── --}}
    <div class="section-title">{{ $permohonan->foto_ktp ? 'D' : 'C' }}. Tanggapan PPID</div>
    <table class="data-table">
        <tr>
            <td>Status</td><td>:</td>
            <td><span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
        </tr>
        @if($permohonan->responded_at)
        <tr>
            <td>Ditanggapi Pada</td><td>:</td>
            <td>{{ \Carbon\Carbon::parse($permohonan->responded_at)->translatedFormat('d F Y, H:i') }} WIB</td>
        </tr>
        @endif
        @if($permohonan->responder)
        <tr>
            <td>Ditanggapi Oleh</td><td>:</td>
            <td>{{ $permohonan->responder->name }}</td>
        </tr>
        @endif
    </table>

    @if($permohonan->response_message)
    <div style="margin-top: 8px; font-size: 9.5pt; color: #555; font-weight: 600;">Pesan Balasan:</div>
    <div class="response-box">{{ $permohonan->response_message }}</div>
    @endif

    {{-- ── FOOTER ── --}}
    <div class="footer-print">
        <div>Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB</div>
        <div>Dokumen ini dicetak dari Sistem Informasi PPID Kabupaten Konawe.</div>
    </div>

</div>

</body>
</html>
