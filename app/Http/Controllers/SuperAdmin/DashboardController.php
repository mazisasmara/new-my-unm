<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\User;
use App\Services\AnalyticsService;

class DashboardController extends Controller
{
    public function index(AnalyticsService $analyticsService)
    {
        $stats = [
            'total_admin' => User::where('role', 'admin')->count(),
            'total_layanan' => Layanan::count(),
            'layanan_aktif' => Layanan::where('status', true)->count(),
            'layanan_nonaktif' => Layanan::where('status', false)->count(),
        ];

        $layananList = Layanan::orderBy('urutan')->get();

        $days = (int) request('days', 7);

        if (! in_array($days, [7, 14, 30])) {
            $days = 7;
        }

        $websiteAnalytics = $analyticsService->websiteVisits($days);

        $websiteTotalVisitors = $analyticsService->totalWebsiteVisitors($days);
        $serviceAnalytics = $analyticsService->serviceVisits($layananList, $days);

        return view('superadmin.dashboard', [
            'title' => 'Dashboard Superadmin',
            'stats' => $stats,
            'layananList' => $layananList,
            'websiteAnalytics' => $websiteAnalytics,
            'websiteTotalVisitors' => $websiteTotalVisitors,
            'serviceAnalytics' => $serviceAnalytics,
            'days' => $days,
        ]);
    }
}
