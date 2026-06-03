<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KlaIndicatorProgress extends Model
{
    use \App\Traits\KlaAuditable;

    protected $guarded = ['id'];
    
    public function indicator(): BelongsTo
    {
        return $this->belongsTo(KlaIndicator::class, 'indicator_id');
    }
    
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
    
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

