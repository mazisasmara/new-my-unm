<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = ['nama_kategori', 'urutan'];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}