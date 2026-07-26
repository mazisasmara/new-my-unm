<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    protected $table = 'sops';
    protected $fillable = ['layanan_id', 'file', 'deskripsi'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}