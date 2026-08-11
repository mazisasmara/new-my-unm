<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <a
        href="{{ route('admin.layanan.index') }}"
        class="inline-block mt-6 text-blue-600 hover:underline"
    >
        Kelola seluruh layanan →
    </a>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Total Layanan</p>
                <p class="text-2xl font-bold">{{ $stats['total_layanan'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Layanan Aktif</p>
                <p class="text-2xl font-bold text-green-600">{{ $stats['layanan_aktif'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Layanan Nonaktif</p>
                <p class="text-2xl font-bold text-gray-400">{{ $stats['layanan_nonaktif'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Total Click</p>
                <p class="text-2xl font-bold text-gray-400">{{ $stats['total_click'] }}</p>
            </div>
        </div>

     <div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-lg font-semibold text-gray-900">
            Statistik Pengunjung Layanan
        </h2>

        <p class="text-sm text-gray-500">
            Unique visitor berdasarkan IP
        </p>
    </div>

    <form method="GET">
        <select
            name="days"
            onchange="this.form.submit()"
            class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
        >
            <option value="7" {{ $days == 7 ? 'selected' : '' }}>
                7 Hari
            </option>

            <option value="14" {{ $days == 14 ? 'selected' : '' }}>
                14 Hari
            </option>

            <option value="30" {{ $days == 30 ? 'selected' : '' }}>
                30 Hari
            </option>
        </select>
    </form>
     </div>

     <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
    <div class="relative h-80">
        <canvas id="serviceAnalyticsChart"></canvas>
    </div>
     </div>

        <h2 class="font-semibold text-lg mb-3">Top 5 Layanan Terpopuler</h2>

        <table class="w-full bg-white rounded-lg shadow-sm text-sm mb-5">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-3">Logo</th>
                    <th class="p-3">Nama Layanan</th>
                    <th class="p-3">Klik</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($popularLayanans as $item)
                    <tr class="border-b">
                        <td class="p-3">
                            <img
                                src="{{ asset('storage/' . $item->logo) }}"
                                alt="{{ $item->nama_layanan }}"
                                class="size-8 rounded-full object-cover"
                            />
                        </td>

                        <td class="p-3 font-medium">
                            {{ $item->nama_layanan }}
                        </td>

                        <td class="p-3">{{ number_format($item->clicks) }}</td>

                        <td class="p-3">
                            <span
                                class="px-2 py-1 rounded text-xs
                        {{ $item->status
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}"
                            >
                                {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script>
    const analytics = @json($analytics);

    const ctx = document
        .getElementById('serviceAnalyticsChart')
        .getContext('2d');

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: analytics.labels,

            datasets: analytics.datasets.map((dataset, index) => ({
                ...dataset,

                borderWidth: 2,
                tension: 0.3,
                fill: false,

                pointRadius: 3,
                pointHoverRadius: 5,
            })),
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                mode: 'index',
                intersect: false,
            },

            plugins: {
                legend: {
                    position: 'bottom',
                },

                tooltip: {
                    mode: 'index',
                    intersect: false,
                },
            },

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        precision: 0,
                    },

                    title: {
                        display: true,
                        text: 'Unique Visitor',
                    },
                },

                x: {
                    title: {
                        display: true,
                        text: 'Tanggal',
                    },
                },
            },
        },
    });
     </script>
</x-layout>
