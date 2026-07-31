<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sop extends Model
{
    protected $fillable = [
        'layanan_id',
        'judul',
        'deskripsi',
        'file',
        'status',
        'urutan',
    ];

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }
}