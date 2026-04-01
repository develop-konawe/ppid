<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationRequest extends Model
{
    protected $fillable = [
        'user_id',
        'kategori_pemohon',
        'nik_no_identitas',
        'nama_lengkap',
        'alamat',
        'email',
        'no_telp',
        'pekerjaan',
        'foto_ktp',
        'dokumen_pendukung',
        'rincian_informasi',
        'tujuan_penggunaan',
        'cara_memperoleh',
        'cara_mendapatkan',
        'information_id',
        'status',
        'response_message',
        'response_file',
        'responded_at',
        'responded_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function information()
    {
        return $this->belongsTo(PublicInformation::class, 'information_id');
    }

    public function responder()
    {
        return $this->belongsTo(User::class, 'responded_by');
    }
}
