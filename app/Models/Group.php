<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['kategori_id','nama_group', 'slug', 'urutan', 'status'];

    protected function casts(): array
      {
          return [
              'status' => 'boolean',
          ];
      }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
    public function layanans(): HasMany
    {
        return $this->hasMany(Layanan::class);
    }
}