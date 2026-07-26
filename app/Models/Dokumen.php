<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumens';
    protected $fillable = ['layanan_id', 'file', 'deskripsi'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}