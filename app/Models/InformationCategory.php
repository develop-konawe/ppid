<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi ke PublicInformation
     */
    public function publicInformations()
    {
        return $this->hasMany(PublicInformation::class, 'category_id');
    }

    /**
     * Scope untuk kategori aktif
     */
//    public function scopeActive($query)
//    {
//        return $query->where('is_active', true);
//    }

    /**
     * Scope untuk diurutkan berdasarkan order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

}
