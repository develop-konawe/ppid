<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationRequest extends Model
{
    protected $fillable = [
        'user_id',
        'information_id',
        'request_reason',
        'status', // pending, approved, rejected
        'response_message',
        'responded_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function information()
    {
        return $this->belongsTo(PublicInformation::class, 'information_id');
    }
}
