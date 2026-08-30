<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\User;
use App\Services\AnalyticsRecorder;

class LayananController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Public Pages
      |--------------------------------------------------------------------------
      */

    public function kategori(AnalyticsRecorder $analytics, $slug = 'universitas')
    {
        if (request()->filled('user') && ctype_digit((string) request('user'))) {
            $legacyUser = User::whereKey(request('user'))->where('role', 'admin')->firstOrFail();

            return redirect()->to(request()->fullUrlWithQuery(['user' => $legacyUser->username]));
        }

        $analytics->record(request(), 'website_visit');

        $filteredUser = null;
        if (request()->filled('user')) {
            $filteredUser = User::where('username', request('user'))
                ->where('role', 'admin')
                ->firstOrFail();
        }

        $kategori = Kategori::where('slug', $slug)
            ->with([
                'groups' => function ($query) {
                    $query->where('status', true)->orderBy('urutan');
                },

                'groups.layanans' => function ($query) use ($filteredUser) {
                    $query
                        ->where('status', true)
                        ->filter(request('search'))
                        ->when($filteredUser, fn ($q) => $q->byUser($filteredUser->id))
                        ->orderBy('urutan');
                },
                'groups.prodis' => function ($query) {
                    $query->where('status', true)->with('links')->orderBy('urutan');
                },
            ])
            ->firstOrFail();
        $views = [
            'portal-prodi' => 'prodi',
        ];

        $view = $views[$slug] ?? 'layanan';

        return view($view, [
            'title' => $kategori->nama_kategori,
            'kategori' => $kategori,
            'filteredUser' => $filteredUser,
        ]);
    }

    public function visit(Layanan $layanan, AnalyticsRecorder $analytics)
    {
        $analytics->record(request(), 'service_visit', layananId: $layanan->id);

        $layanan->increment('clicks');

        return redirect()->away($layanan->link);
    }
}
