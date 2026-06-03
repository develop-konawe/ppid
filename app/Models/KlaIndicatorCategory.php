<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KlaIndicatorCategory extends Model
{
    use \App\Traits\KlaAuditable;

    protected $guarded = ['id'];
    
    public function indicators(): HasMany
    {
        return $this->hasMany(KlaIndicator::class, 'category_id');
    }
    
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

