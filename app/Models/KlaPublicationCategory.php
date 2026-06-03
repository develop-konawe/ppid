<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KlaPublicationCategory extends Model
{
    use \App\Traits\KlaAuditable;

    protected $guarded = ['id'];
}

