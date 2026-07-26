<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $fillable = ['fakultas_id', 'nama_unit'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function layanan()
    {
        return $this->hasMany(Layanan::class);
    }
}