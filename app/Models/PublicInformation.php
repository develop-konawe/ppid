<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicInformation extends Model
{
    protected $table = 'public_informations';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'file_path',
        'is_active',
        'is_featured',
        'views',
        'published_at',
        'source_type',
        'opd_id',
        'created_by',
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
