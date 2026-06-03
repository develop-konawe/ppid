<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaStatistic extends Model
{
    use \App\Traits\KlaAuditable;

    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'icon',
        'color',
        'description',
        'is_active',
        'order',
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

