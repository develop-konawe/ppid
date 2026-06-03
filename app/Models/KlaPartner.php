<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KlaPartner extends Model
{
    use \App\Traits\KlaAuditable;

    protected $guarded = ['id'];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(KlaPartnerCategory::class, 'category_id');
    }
    
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

