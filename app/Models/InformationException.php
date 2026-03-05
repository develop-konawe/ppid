<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationException extends Model
{
    protected $fillable = [
        'public_information_id',
        'exception_reason',
        'legal_basis',
        'valid_until',
    ];

    public function publicInformation()
    {
        return $this->belongsTo(PublicInformation::class);
    }
}
