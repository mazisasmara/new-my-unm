<?php

namespace Database\Seeders;

use App\Models\AnalyticsLog;
use App\Models\Layanan;
use App\Models\ProdiLink;
use Illuminate\Database\Seeder;

class AnalyticsLogSeeder extends Seeder
{
    private const USER_AGENT = 'UNM Analytics Seeder';

    public function run(): void
    {
        // Hanya ganti data dummy; traffic asli tetap dipertahankan.
        AnalyticsLog::where('user_agent', self::USER_AGENT)->delete();

        $layanans = Layanan::all();
        $prodiLinks = ProdiLink::all();
        $rows = [];

        // Hari ini dan delapan hari sebelumnya.
        foreach (range(8, 0) as $daysAgo) {
            $date = today()->subDays($daysAgo)->toDateString();
            $timestamp = now();

            // Traffic website: 18-30 unique visitor per hari.
            $websiteVisitors = 18 + (($daysAgo * 7) % 13);
            for ($visitor = 1; $visitor <= $websiteVisitors; $visitor++) {
                $rows[] = $this->row(
                    "172.20.{$daysAgo}.{$visitor}",
                    'website_visit',
                    $date,
                    $timestamp
                );
            }

            // Visitor layanan: pola berbeda untuk setiap layanan dan hari.
            foreach ($layanans as $layanan) {
                $visitorCount = 2 + (($layanan->id + ($daysAgo * 3)) % 7);
                for ($visitor = 1; $visitor <= $visitorCount; $visitor++) {
                    $rows[] = $this->row(
                        "10.{$daysAgo}.{$layanan->id}.{$visitor}",
                        'service_visit',
                        $date,
                        $timestamp,
                        layananId: $layanan->id
                    );
                }
            }

            // Visitor tautan prodi agar dashboard admin prodi juga memiliki chart.
            foreach ($prodiLinks as $link) {
                $visitorCount = 1 + (($link->id + $daysAgo) % 5);
                for ($visitor = 1; $visitor <= $visitorCount; $visitor++) {
                    $rows[] = $this->row(
                        "10.200.{$daysAgo}.".(($link->id * 10) + $visitor),
                        'prodi_link_visit',
                        $date,
                        $timestamp,
                        prodiLinkId: $link->id
                    );
                }
            }
        }

        foreach (array_chunk($rows, 500) as $chunk) {
            AnalyticsLog::insert($chunk);
        }

        $this->command?->info('Traffic website dan visitor untuk 9 hari berhasil dibuat.');
    }

    private function row(
        string $ip,
        string $type,
        string $date,
        $timestamp,
        ?int $layananId = null,
        ?int $prodiLinkId = null
    ): array {
        return [
            'ip_address' => $ip,
            'log_type' => $type,
            'layanan_id' => $layananId,
            'prodi_link_id' => $prodiLinkId,
            'user_agent' => self::USER_AGENT,
            'visited_at' => $date,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
