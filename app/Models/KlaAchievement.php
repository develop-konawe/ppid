<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaAchievement extends Model
{
    use \App\Traits\KlaAuditable;

    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'description',
        'image',
        'awarded_by',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

