<?php

namespace App\Services;

use App\Models\AnalyticsLog;
use Illuminate\Http\Request;
use Throwable;

class AnalyticsRecorder
{
    /**
     * Record at most one visit for the same browser, day, type, and target.
     *
     * Analytics is deliberately best-effort: an unavailable database must not
     * prevent the primary request from being served.
     */
    public function record(Request $request, string $type, ?int $layananId = null, ?int $prodiLinkId = null): void
    {
        $date = now()->toDateString();
        $visitorKey = hash('sha256', implode('|', [
            $request->ip(),
            $date,
            $type,
            $layananId ?? '-',
            $prodiLinkId ?? '-',
        ]));
        $sessionKey = 'analytics.recorded.'.$visitorKey;

        try {
            if ($request->hasSession() && $request->session()->has($sessionKey)) {
                return;
            }

            // Set this before touching MySQL so an outage does not cause every
            // page view from the same browser to keep retrying the failed query.
            if ($request->hasSession()) {
                $request->session()->put($sessionKey, true);
            }

            AnalyticsLog::query()->insertOrIgnore([
                'ip_address' => $request->ip(),
                'visitor_key' => $visitorKey,
                'log_type' => $type,
                'layanan_id' => $layananId,
                'prodi_link_id' => $prodiLinkId,
                'user_agent' => $request->userAgent(),
                'visited_at' => $date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Throwable $exception) {
            // Never let optional analytics take down the application.
            try {
                report($exception);
            } catch (Throwable) {
                // Reporting may also use an unavailable external service.
            }
        }
    }
}
