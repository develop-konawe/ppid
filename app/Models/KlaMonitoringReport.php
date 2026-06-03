<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KlaMonitoringReport extends Model
{
    use \App\Traits\KlaAuditable;

    protected $guarded = ['id'];
    
    protected $casts = [
        'report_date' => 'date',
    ];
    
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

