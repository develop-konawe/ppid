<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KlaIndicator extends Model
{
    use \App\Traits\KlaAuditable;

    protected $guarded = ['id'];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(KlaIndicatorCategory::class, 'category_id');
    }
    
    public function cluster(): BelongsTo
    {
        return $this->belongsTo(KlaCluster::class, 'cluster_id');
    }
    
    public function progress(): HasMany
    {
        return $this->hasMany(KlaIndicatorProgress::class, 'indicator_id');
    }
    
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

