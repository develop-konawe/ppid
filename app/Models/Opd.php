<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    /** @use HasFactory<\Database\Factories\OpdFactory> */
    use HasFactory;

    protected $fillable = [
        'id_unit',
        'nama_opd',
        'singkatan',
        'tipe_unit',
        'keterangan',
        'website',
        'email',
        'telepon',
        'alamat',
        'latitude',
        'longitude',
        'file_dasar_hukum',
        'logo',
        'kepala_opd',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
