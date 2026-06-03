<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KlaPartnerCategory extends Model
{
    use \App\Traits\KlaAuditable;

    protected $guarded = ['id'];
    
    public function partners(): HasMany
    {
        return $this->hasMany(KlaPartner::class, 'category_id');
    }
}

