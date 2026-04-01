<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicInformation extends Model
{
    protected $table = 'public_informations';

    protected $fillable = [
        'category_id',
        'opd_id',              // Wajib ada
        'title',
        'slug',
        'description',
        'information_type',    // Wajib ada
        'report_level',        // Wajib ada
        'year',                // Wajib ada
        'image',
        'file_path',
        'file_url',            // INI YANG MEMBUAT LINK TIDAK TERSIMPAN
        'file_type',
        'file_size',
        'status',              // Wajib ada
        'views',
        'published_at',
        'created_by',
        'approved_by',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function category()
    {
        return $this->belongsTo(InformationCategory::class);
    }

    /**
     * Relasi ke tabel information_exceptions
     * Satu informasi publik (dikecualikan) memiliki satu detail pengecualian
     */
    public function exception()
    {
        return $this->hasOne(InformationException::class, 'public_information_id');
    }

}
