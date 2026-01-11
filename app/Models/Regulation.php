<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    /** @use HasFactory<\Database\Factories\RegulationFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'doc_url',
        'issue_date',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
