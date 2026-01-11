<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    /** @use HasFactory<\Database\Factories\OpdFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_opd',
        'singkatan',
        'website',
        'email',
        'telepon',
        'alamat',
        'logo',
        'kepala_opd',
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
