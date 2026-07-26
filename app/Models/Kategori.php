<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = ['nama_kategori', 'urutan'];

    public function layanan()
    {
        return $this->hasMany(Layanan::class);
    }
}