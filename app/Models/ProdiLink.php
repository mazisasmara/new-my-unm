<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProdiLink extends Model
{
    protected $fillable = ['label', 'url', 'urutan'];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }

    public function analyticsLogs(): HasMany
    {
        return $this->hasMany(AnalyticsLog::class);
    }
}
