<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mb-7 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div><h2 class="text-xl font-bold">Ringkasan Portal Prodi</h2><p class="text-sm text-slate-500">Statistik tautan publik milik {{ auth()->user()->group->nama_group }}.</p></div>
        <a href="{{ route('admin.prodi.create') }}" class="rounded-xl bg-blue-700 px-4 py-2.5 text-center text-sm font-semibold text-white">+ Tambah Prodi</a>
    </div>

    <div class="mb-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Total Judul</p><p class="mt-2 text-3xl font-bold text-blue-900">{{ $prodis->count() }}</p></div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Portal Aktif</p><p class="mt-2 text-3xl font-bold text-emerald-600">{{ $prodis->where('status', true)->count() }}</p></div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Total Tautan</p><p class="mt-2 text-3xl font-bold text-amber-600">{{ $totalLinks }}</p></div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Total Klik</p><p class="mt-2 text-3xl font-bold text-violet-700">{{ number_format($totalClicks) }}</p></div>
    </div>

    <section class="mb-7 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div><h3 class="font-bold text-slate-900">Pengunjung Tautan Prodi</h3><p class="text-sm text-slate-500">Unique visitor per tautan dan per hari.</p></div>
            <form method="GET"><select name="days" onchange="this.form.submit()" class="rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm"><option value="7" @selected($days === 7)>7 Hari</option><option value="14" @selected($days === 14)>14 Hari</option><option value="30" @selected($days === 30)>30 Hari</option></select></form>
        </div>
        @if(count($analytics['datasets']))
            <div class="relative h-80"><canvas id="prodiAnalyticsChart"></canvas></div>
        @else
            <div class="rounded-xl bg-slate-50 p-10 text-center text-sm text-slate-500">Belum ada tautan untuk ditampilkan pada chart.</div>
        @endif
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-5 py-4"><h3 class="font-bold">Tautan Terpopuler</h3></div>
        <div class="divide-y divide-slate-100">
            @forelse($popularLinks as $link)
                <div class="flex items-center justify-between gap-4 px-5 py-3.5"><div><p class="font-medium text-slate-800">{{ $link->label }}</p><p class="text-xs text-slate-500">{{ $link->prodi->judul }}</p></div><span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-bold text-blue-700">{{ number_format($link->clicks) }} klik</span></div>
            @empty
                <p class="px-5 py-8 text-center text-sm text-slate-500">Belum ada data tautan.</p>
            @endforelse
        </div>
    </section>

    @if(count($analytics['datasets']))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const prodiAnalytics = @json($analytics);
            const colors = ['#1d4ed8', '#7c3aed', '#059669', '#d97706', '#dc2626', '#0891b2', '#4f46e5'];
            new Chart(document.getElementById('prodiAnalyticsChart'), {
                type: 'line',
                data: { labels: prodiAnalytics.labels, datasets: prodiAnalytics.datasets.map((dataset, index) => ({ ...dataset, borderColor: colors[index % colors.length], backgroundColor: colors[index % colors.length] + '20', tension: .35, borderWidth: 2, pointRadius: 3 })) },
                options: { responsive: true, maintainAspectRatio: false, interaction: { mode: 'index', intersect: false }, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, title: { display: true, text: 'Unique Visitor' } }, x: { title: { display: true, text: 'Tanggal' } } } }
            });
        </script>
    @endif
</x-layout>
