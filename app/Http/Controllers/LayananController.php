<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Pages
    |--------------------------------------------------------------------------
    */

    public function kategori($slug = 'universitas')
    {
        $kategori = Kategori::where('slug', $slug)
            ->with(['groups.layanans' => function ($query) {
                $query->where('status', true)
                      ->filter(request('search'))
                      ->when(
                          request('user'),
                          fn ($q, $userId) => $q->byUser(request('user'))
                      )
                      ->orderBy('urutan');
            }])
            ->firstOrFail();
    
        return view('layanan', [
            'title' => $kategori->nama_kategori,
            'kategori' => $kategori,
        ]);
    }

    public function visit(Layanan $layanan)
    {
        $layanan->increment('clicks');
        return redirect($layanan->link);
    }
}
