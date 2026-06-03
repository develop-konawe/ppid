<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaRegulation extends Model
{
    use \App\Traits\KlaAuditable;

    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'doc_url',
        'issue_date',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'is_active'  => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

