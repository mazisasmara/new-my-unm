<?php

namespace App\Services;

use App\Models\AnalyticsLog;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AnalyticsService
{
  /**
   * Mengambil statistik kunjungan layanan untuk periode tertentu.
   *
   * @param Collection<int, Layanan> $layanans
   * @param int $days
   * @return array
   */
  public function serviceVisits(Collection $layanans, int $days = 7): array
  {
    $days = in_array($days, [7, 14, 30]) ? $days : 7;

    $startDate = now()
      ->subDays($days - 1)
      ->startOfDay();

    $endDate = now()->endOfDay();

    $layananIds = $layanans->pluck("id");

    $logs = AnalyticsLog::query()
      ->where("log_type", "service_visit")
      ->whereIn("layanan_id", $layananIds)
      ->whereBetween("visited_at", [
        $startDate->toDateString(),
        $endDate->toDateString(),
      ])
      ->selectRaw("visited_at, layanan_id, COUNT(*) as total")
      ->groupBy("visited_at", "layanan_id")
      ->orderBy("visited_at")
      ->get();

    return [
      "labels" => $this->dateLabels($days),
      "datasets" => $this->buildDatasets($layanans, $logs, $days),
    ];
  }

  /**
   * Membuat daftar tanggal untuk sumbu X grafik.
   */
  private function dateLabels(int $days): array
  {
    return collect(range($days - 1, 0))
      ->map(
        fn($day) => now()
          ->subDays($day)
          ->toDateString()
      )
      ->values()
      ->all();
  }

  /**
   * Membuat dataset untuk setiap layanan.
   */
  private function buildDatasets(
    Collection $layanans,
    Collection $logs,
    int $days
  ): array {
    return $layanans
      ->map(function ($layanan) use ($logs, $days) {
        $data = collect(range($days - 1, 0))
          ->map(function ($day) use ($layanan, $logs) {
            $date = now()
              ->subDays($day)
              ->toDateString();

            $log = $logs->first(
              fn($item) => $item->layanan_id == $layanan->id &&
                Carbon::parse($item->visited_at)->toDateString() === $date
            );

            return $log ? (int) $log->total : 0;
          })
          ->values()
          ->all();

        return [
          "label" => $layanan->nama_layanan,
          "data" => $data,
        ];
      })
      ->values()
      ->all();
  }
}
