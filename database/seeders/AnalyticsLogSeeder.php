<?php

namespace Database\Seeders;

use App\Models\AnalyticsLog;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AnalyticsLogSeeder extends Seeder
{
  public function run(): void
  {
    // Hapus data analytics dummy sebelumnya
    AnalyticsLog::query()->delete();

    $layanans = Layanan::all();

    if ($layanans->isEmpty()) {
      $this->command->warn("Tidak ada layanan. Seeder dibatalkan.");
      return;
    }

    /*
     * Dummy service visit selama 7 hari terakhir.
     *
     * Setiap IP hanya dihitung satu kali per layanan
     * dalam satu hari.
     */
    foreach ($layanans as $layanan) {
      for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
        $date = Carbon::today()->subDays($daysAgo);

        // Jumlah visitor dibuat berbeda-beda agar grafik terlihat.
        $visitorCount = rand(1, 8);

        for ($i = 1; $i <= $visitorCount; $i++) {
          AnalyticsLog::create([
            "ip_address" => "10.0.{$layanan->id}.{$i}",
            "log_type" => "service_visit",
            "layanan_id" => $layanan->id,
            "user_agent" => "Dummy Analytics Seeder",
            "visited_at" => $date->toDateString(),
          ]);
        }
      }
    }

    /*
     * Dummy website visitor.
     *
     * Website visitor tidak memiliki layanan_id.
     */
    for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
      $date = Carbon::today()->subDays($daysAgo);

      $visitorCount = rand(5, 15);

      for ($i = 1; $i <= $visitorCount; $i++) {
        AnalyticsLog::create([
          "ip_address" => "192.168.1.{$i}",
          "log_type" => "website_visit",
          "layanan_id" => null,
          "user_agent" => "Dummy Analytics Seeder",
          "visited_at" => $date->toDateString(),
        ]);
      }
    }

    $this->command->info("Dummy analytics berhasil dibuat.");
  }
}
