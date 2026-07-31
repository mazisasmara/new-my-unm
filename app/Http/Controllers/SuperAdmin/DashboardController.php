<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_admin'      => User::where('role', 'admin')->count(),
            'total_layanan'    => Layanan::count(),
            'layanan_aktif'    => Layanan::where('status', true)->count(),
            'layanan_nonaktif' => Layanan::where('status', false)->count(),
        ];

        $layananList = Layanan::with(['unit.fakultas', 'kategori'])
            ->orderBy('urutan')
            ->get();

        return view('superadmin.dashboard', compact('stats', 'layananList'), ['title' => 'Super Admin']);
    }
}