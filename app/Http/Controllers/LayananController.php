<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\User;
use App\Models\AnalyticsLog;
use Illuminate\Http\Request;

class LayananController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Public Pages
    |--------------------------------------------------------------------------
    */

  public function kategori($slug = "universitas")
  {
    $today = now()->toDateString();
    $ip = request()->ip();

    $exists = AnalyticsLog::where("ip_address", $ip)
      ->where("visited_at", $today)
      ->where("log_type", "website_visit")
      ->exists();

    if (!$exists) {
      AnalyticsLog::create([
        "ip_address" => $ip,
        "log_type" => "website_visit",
        "layanan_id" => null,
        "user_agent" => request()->userAgent(),
        "visited_at" => $today,
      ]);
    }

    $kategori = Kategori::where("slug", $slug)
      ->with([
        "groups" => function ($query) {
          $query->where("status", true)->orderBy("urutan");
        },

        "groups.layanans" => function ($query) {
          $query
            ->where("status", true)
            ->filter(request("search"))
            ->when(request("user"), fn($q, $userId) => $q->byUser($userId))
            ->orderBy("urutan");
        },
      ])
      ->firstOrFail();

    return view("layanan", [
      "title" => $kategori->nama_kategori,
      "kategori" => $kategori,
    ]);
  }

  public function visit(Layanan $layanan)
  {
    $today = now()->toDateString();

    $exists = AnalyticsLog::where("ip_address", request()->ip())
      ->where("visited_at", $today)
      ->where("log_type", "service_visit")
      ->where("layanan_id", $layanan->id)
      ->exists();

    if (!$exists) {
      AnalyticsLog::create([
        "ip_address" => request()->ip(),
        "log_type" => "service_visit",
        "layanan_id" => $layanan->id,
        "user_agent" => request()->userAgent(),
        "visited_at" => $today,
      ]);
    }

    $layanan->increment("clicks");

    return redirect()->away($layanan->link);
  }
}
