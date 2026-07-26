<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id','kategori_id', 'prodi_id', 'nama_layanan', 'logo', 'deskripsi', 'link'])]
class Layanan extends Model
{
    /** @use HasFactory<\Database\Factories\LayananFactory> */
    // use HasFactory;
}
