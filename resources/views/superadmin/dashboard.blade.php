<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div><h2 class="text-xl font-bold text-slate-800">Dashboard Superadmin</h2><p class="text-sm text-slate-500">Pantau ringkasan layanan dan aktivitas website.</p></div>
        <a href="{{ route('superadmin.admins.index') }}" class="rounded-md bg-blue-600 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-700">Kelola Akun Admin</a>
    </div>
    <div class="mb-7 grid grid-cols-2 gap-4 lg:grid-cols-5">
        @foreach([['Total Admin', $stats['total_admin'], 'text-slate-800'], ['Total Layanan', $stats['total_layanan'], 'text-blue-700'], ['Layanan Aktif', $stats['layanan_aktif'], 'text-green-600'], ['Layanan Nonaktif', $stats['layanan_nonaktif'], 'text-slate-500'], ['Kunjungan Website', $websiteTotalVisitors, 'text-violet-700']] as [$label, $value, $color])
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm"><p class="text-sm text-slate-500">{{ $label }}</p><p class="mt-1 text-2xl font-bold {{ $color }}">{{ number_format($value) }}</p>@if($loop->last)<p class="mt-1 text-xs text-slate-400">{{ $days }} hari terakhir</p>@endif</div>
        @endforeach
    </div>
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div><h2 class="text-lg font-bold text-slate-800">Statistik Pengunjung</h2><p class="text-sm text-slate-500">Unique visitor website dan layanan berdasarkan periode.</p></div>
        <form method="GET"><select name="days" onchange="this.form.submit()" class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm"><option value="7" @selected($days === 7)>7 Hari</option><option value="14" @selected($days === 14)>14 Hari</option><option value="30" @selected($days === 30)>30 Hari</option></select></form>
    </div>
    <div class="grid gap-5 xl:grid-cols-2">
        <section class="rounded-lg border border-slate-200 bg-white shadow-sm"><div class="border-b border-slate-200 bg-slate-50 px-5 py-4"><h3 class="font-bold text-slate-800">Kunjungan Website</h3><p class="text-sm text-slate-500">Jumlah pengunjung unik setiap hari.</p></div><div class="relative h-80 p-5"><canvas id="websiteAnalyticsChart"></canvas></div></section>
        <section class="rounded-lg border border-slate-200 bg-white shadow-sm"><div class="border-b border-slate-200 bg-slate-50 px-5 py-4"><h3 class="font-bold text-slate-800">Kunjungan Layanan</h3><p class="text-sm text-slate-500">Perbandingan kunjungan setiap layanan.</p></div><div class="relative h-80 p-5"><canvas id="serviceAnalyticsChart"></canvas></div></section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartColors = ['#2563eb', '#7c3aed', '#059669', '#d97706', '#dc2626', '#0891b2', '#4f46e5'];
        function renderAnalyticsChart(id, analytics, filled = false) {
            const canvas = document.getElementById(id); if (!canvas) return;
            new Chart(canvas, { type: 'line', data: { labels: analytics.labels, datasets: analytics.datasets.map((dataset, index) => ({ ...dataset, borderColor: chartColors[index % chartColors.length], backgroundColor: chartColors[index % chartColors.length] + '20', borderWidth: 2, tension: .3, fill: filled, pointRadius: 3 })) }, options: { responsive: true, maintainAspectRatio: false, interaction: { mode: 'index', intersect: false }, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } } });
        }
        renderAnalyticsChart('websiteAnalyticsChart', @json($websiteAnalytics), true);
        renderAnalyticsChart('serviceAnalyticsChart', @json($serviceAnalytics));
    </script>
</x-layout>
