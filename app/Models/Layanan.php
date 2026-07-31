<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans';
    protected $fillable = [
        'users_id', 'kategori_id', 'unit_id',
        'nama_layanan', 'logo', 'deskripsi', 'link', 'status', 'urutan',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function sop()
    {
        return $this->hasMany(Sop::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    public function scopeMilikFakultas($query, $fakultasId)
    {
        return $query->whereHas('unit', fn ($q) => $q->where('fakultas_id', $fakultasId));
    }
}