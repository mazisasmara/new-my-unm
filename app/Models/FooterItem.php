<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterItem extends Model
{
    protected $fillable = [
        'type',
        'label',
        'value',
        'url',
        'icon',
        'urutan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'urutan' => 'integer',
        ];
    }
}
