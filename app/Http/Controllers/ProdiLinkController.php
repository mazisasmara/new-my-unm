<?php

namespace App\Http\Controllers;

use App\Models\ProdiLink;
use App\Services\AnalyticsRecorder;

class ProdiLinkController extends Controller
{
    public function visit(ProdiLink $prodiLink, AnalyticsRecorder $analytics)
    {
        abort_unless($prodiLink->prodi()->where('status', true)->exists(), 404);

        $analytics->record(request(), 'prodi_link_visit', prodiLinkId: $prodiLink->id);

        $prodiLink->increment('clicks');

        return redirect()->away($prodiLink->url);
    }
}
