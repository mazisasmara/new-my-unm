<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsLog;
use App\Models\ProdiLink;

class ProdiLinkController extends Controller
{
    public function visit(ProdiLink $prodiLink)
    {
        abort_unless($prodiLink->prodi()->where('status', true)->exists(), 404);

        $today = now()->toDateString();
        $alreadyRecorded = AnalyticsLog::where('ip_address', request()->ip())
            ->where('visited_at', $today)
            ->where('log_type', 'prodi_link_visit')
            ->where('prodi_link_id', $prodiLink->id)
            ->exists();

        if (! $alreadyRecorded) {
            AnalyticsLog::create([
                'ip_address' => request()->ip(),
                'log_type' => 'prodi_link_visit',
                'layanan_id' => null,
                'prodi_link_id' => $prodiLink->id,
                'user_agent' => request()->userAgent(),
                'visited_at' => $today,
            ]);
        }

        $prodiLink->increment('clicks');

        return redirect()->away($prodiLink->url);
    }
}
