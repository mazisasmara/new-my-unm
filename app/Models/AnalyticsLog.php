<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalyticsLog extends Model
{
  protected $fillable = [
    "ip_address",
    "log_type",
    "layanan_id",
    "user_agent",
    "visited_at",
  ];

  protected function casts(): array
  {
    return [
      "visited_at" => "date",
    ];
  }

  public function layanan(): BelongsTo
  {
    return $this->belongsTo(Layanan::class);
  }
}
