<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permohonan Informasi Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #0056b3;
            margin: 0;
        }
        .content p {
            margin-bottom: 10px;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .detail-table th, .detail-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .detail-table th {
            background-color: #f8f9fa;
            width: 35%;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .btn {
            display: inline-block;
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Permohonan Informasi Baru</h1>
        </div>
        <div class="content">
            <p>Halo Admin,</p>
            <p>Ada permohonan informasi baru yang masuk melalui website PPID Konawe. Berikut adalah rinciannya:</p>
            
            <table class="detail-table">
                <tr>
                    <th>Kategori Pemohon</th>
                    <td>{{ $informationRequest->kategori_pemohon }}</td>
                </tr>
                <tr>
                    <th>NIK / No Identitas</th>
                    <td>{{ $informationRequest->nik_no_identitas }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $informationRequest->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $informationRequest->email }}</td>
                </tr>
                <tr>
                    <th>No. Telp</th>
                    <td>{{ $informationRequest->no_telp }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $informationRequest->pekerjaan }}</td>
                </tr>
                <tr>
                    <th>Rincian Informasi</th>
                    <td>{{ $informationRequest->rincian_informasi }}</td>
                </tr>
                <tr>
                    <th>Tujuan Penggunaan</th>
                    <td>{{ $informationRequest->tujuan_penggunaan }}</td>
                </tr>
                <tr>
                    <th>Cara Memperoleh Info</th>
                    <td>{{ $informationRequest->cara_memperoleh }}</td>
                </tr>
                <tr>
                    <th>Cara Mendapatkan Salinan</th>
                    <td>{{ $informationRequest->cara_mendapatkan }}</td>
                </tr>
            </table>

            <div style="text-align: center;">
                <a href="{{ url('/admin') }}" class="btn" style="color: white;text-decoration: none;">Buka Dasbor Admin</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} PPID Kabupaten Konawe. Notifikasi Sistem.</p>
        </div>
    </div>
</body>
</html>
