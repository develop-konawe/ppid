<?php

namespace App\Traits;

use App\Models\KlaAuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait KlaAuditable
{
    public static function bootKlaAuditable()
    {
        static::created(function ($model) {
            self::logAudit('created', $model);
        });

        static::updated(function ($model) {
            self::logAudit('updated', $model);
        });

        static::deleted(function ($model) {
            self::logAudit('deleted', $model);
        });
    }

    protected static function logAudit($event, $model)
    {
        $oldValues = $event === 'updated' ? $model->getOriginal() : null;
        $newValues = $event !== 'deleted' ? $model->getAttributes() : null;

        KlaAuditLog::create([
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'user_id' => Auth::id(),
            'event' => $event,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
