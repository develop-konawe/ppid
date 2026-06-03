<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaComplaint extends Model
{
    use \App\Traits\KlaAuditable;

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'response',
        'attachment',
        'internal_notes',
    ];
}

