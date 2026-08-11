<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-6xl mx-auto py-8 px-4">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Dashboard Superadmin
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Pantau layanan dan aktivitas website secara keseluruhan.
                </p>
            </div>

            <a
                href="{{ route('superadmin.admins.index') }}"
                class="inline-flex items-center justify-center px-4 py-2 rounded-lg
                       bg-blue-600 text-white text-sm font-medium
                       hover:bg-blue-700 transition"
            >
                Kelola Akun Admin →
            </a>
        </div>


        {{-- STATISTIK UTAMA --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500">Total Admin</p>

                <p class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $stats['total_admin'] }}
                </p>
            </div>


            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500">Total Layanan</p>

                <p class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $stats['total_layanan'] }}
                </p>
            </div>


            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500">Layanan Aktif</p>

                <p class="text-2xl font-bold text-green-600 mt-1">
                    {{ $stats['layanan_aktif'] }}
                </p>
            </div>


            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500">Layanan Nonaktif</p>

                <p class="text-2xl font-bold text-gray-400 mt-1">
                    {{ $stats['layanan_nonaktif'] }}
                </p>
            </div>


            <div class="bg-white p-4 rounded-xl shadow-sm border border-blue-100">
                <p class="text-sm text-gray-500">
                    Kunjungan Website
                </p>

                <p class="text-2xl font-bold text-blue-600 mt-1">
                    {{ $websiteTotalVisitors }}
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    {{ $days }} hari terakhir
                </p>
            </div>

        </div>


        {{-- ANALYTICS --}}
        <div class="mb-8">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">

                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        Statistik Pengunjung
                    </h2>

                    <p class="text-sm text-gray-500">
                        Pantau aktivitas website dan layanan.
                    </p>
                </div>


                {{-- FILTER PERIODE --}}
                <form method="GET">

                    @if(request('kategori'))
                        <input
                            type="hidden"
                            name="kategori"
                            value="{{ request('kategori') }}"
                        >
                    @endif

                    @if(request('search'))
                        <input
                            type="hidden"
                            name="search"
                            value="{{ request('search') }}"
                        >
                    @endif

                    <select
                        name="days"
                        onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white"
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


            {{-- WEBSITE --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-5">

                <div class="mb-4">

                    <h3 class="font-semibold text-gray-800">
                        Kunjungan Website
                    </h3>

                    <p class="text-sm text-gray-500">
                        Jumlah kunjungan website setiap hari.
                    </p>

                </div>

                <div class="relative h-72 md:h-80">
                    <canvas id="websiteAnalyticsChart"></canvas>
                </div>

            </div>


            {{-- LAYANAN --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">

                <div class="mb-4">

                    <h3 class="font-semibold text-gray-800">
                        Kunjungan Layanan
                    </h3>

                    <p class="text-sm text-gray-500">
                        Jumlah layanan yang dibuka setiap hari.
                    </p>

                </div>

                <div class="relative h-96">
                    <canvas id="serviceAnalyticsChart"></canvas>
                </div>

            </div>

        </div>


        {{-- SEMUA LAYANAN --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-3">

            <div>
                <h2 class="font-semibold text-lg text-gray-800">
                    Semua Layanan
                </h2>

                <p class="text-sm text-gray-500">
                    Daftar seluruh layanan yang tersedia.
                </p>
            </div>


            {{-- FILTER KATEGORI --}}
            <form method="GET">

                <input
                    type="hidden"
                    name="days"
                    value="{{ $days }}"
                >

                @if(request('search'))
                    <input
                        type="hidden"
                        name="search"
                        value="{{ request('search') }}"
                    >
                @endif

                <select
                    name="kategori"
                    onchange="this.form.submit()"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white"
                >
                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach ($kategoris as $kategori)

                        <option
                            value="{{ $kategori->id }}"
                            {{ request('kategori') == $kategori->id ? 'selected' : '' }}
                        >
                            {{ $kategori->nama_kategori }}
                        </option>

                    @endforeach

                </select>

            </form>

        </div>


        {{-- SEARCH --}}
        <div class="mb-4">
            <x-search></x-search>
        </div>


        {{-- TABEL LAYANAN --}}
        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-100 mb-8">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b">

                    <tr class="text-left text-gray-600">

                        <th class="p-3 font-semibold">ID</th>
                        <th class="p-3 font-semibold">Nama</th>
                        <th class="p-3 font-semibold">Logo</th>
                        <th class="p-3 font-semibold">Kategori</th>
                        <th class="p-3 font-semibold">Click</th>
                        <th class="p-3 font-semibold">Status</th>
                        <th class="p-3 font-semibold">Dibuat</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($layananList as $item)

                        <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">

                            <td class="p-3 text-gray-500">
                                {{ $item->id }}
                            </td>

                            <td class="p-3 font-medium text-gray-800">
                                {{ $item->nama_layanan }}
                            </td>

                            <td class="p-3">

                                <img
                                    src="{{ Storage::url($item->logo ?? 'layanan-logo/gambar.png') }}"
                                    alt="Logo {{ $item->nama_layanan }}"
                                    class="size-9 rounded-full object-cover border"
                                >

                            </td>

                            <td class="p-3 text-gray-600">
                                {{ $item->group->kategori->nama_kategori ?? '-' }}
                            </td>

                            <td class="p-3 font-medium">
                                {{ $item->clicks }}
                            </td>

                            <td class="p-3">

                                @if($item->status)

                                    <span class="inline-flex items-center px-2.5 py-1
                                                 rounded-full text-xs font-medium
                                                 bg-green-100 text-green-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-1
                                                 rounded-full text-xs font-medium
                                                 bg-gray-100 text-gray-500">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                            <td class="p-3 text-gray-500">
                                {{ $item->created_at->diffForHumans() }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="7"
                                class="p-8 text-center text-gray-500"
                            >
                                Tidak ada layanan ditemukan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- SEMUA GROUP --}}
        <div class="mb-3">

            <h2 class="font-semibold text-lg text-gray-800">
                Semua Group
            </h2>

            <p class="text-sm text-gray-500">
                Daftar group dan admin yang mengelolanya.
            </p>

        </div>


        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-100">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b">

                    <tr class="text-left text-gray-600">

                        <th class="p-3 font-semibold">ID</th>
                        <th class="p-3 font-semibold">Nama Group</th>
                        <th class="p-3 font-semibold">Username Pemilik</th>
                        <th class="p-3 font-semibold">Slug</th>
                        <th class="p-3 font-semibold">Urutan</th>
                        <th class="p-3 font-semibold">Status</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($groups as $item)

                        <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">

                            <td class="p-3 text-gray-500">
                                {{ $item->id }}
                            </td>

                            <td class="p-3 font-medium text-gray-800">
                                {{ $item->nama_group }}
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ $item->user->username ?? 'Tidak ditemukan' }}
                            </td>

                            <td class="p-3 text-gray-500">
                                {{ $item->slug }}
                            </td>

                            <td class="p-3">
                                {{ $item->urutan }}
                            </td>

                            <td class="p-3">

                                @if($item->status)

                                    <span class="inline-flex items-center px-2.5 py-1
                                                 rounded-full text-xs font-medium
                                                 bg-green-100 text-green-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-1
                                                 rounded-full text-xs font-medium
                                                 bg-gray-100 text-gray-500">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="6"
                                class="p-8 text-center text-gray-500"
                            >
                                Tidak ada group ditemukan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const websiteAnalytics = @json($websiteAnalytics);
        const serviceAnalytics = @json($serviceAnalytics);


        // =========================
        // WEBSITE ANALYTICS
        // =========================

        const websiteChart = document.getElementById(
            'websiteAnalyticsChart'
        );

        if (websiteChart) {

            new Chart(websiteChart, {

                type: 'line',

                data: {
                    labels: websiteAnalytics.labels,

                    datasets: websiteAnalytics.datasets.map(dataset => ({
                        ...dataset,

                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,

                        pointRadius: 3,
                        pointHoverRadius: 5,
                    })),
                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false,

                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },

                    plugins: {

                        legend: {
                            display: true,
                        },

                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return `${context.dataset.label}: ${context.parsed.y} kunjungan`;

                                }

                            }

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {
                                precision: 0,
                            },

                        },

                    },

                },

            });

        }


        // =========================
        // SERVICE ANALYTICS
        // =========================

        const serviceChart = document.getElementById(
            'serviceAnalyticsChart'
        );

        if (serviceChart) {

            new Chart(serviceChart, {

                type: 'line',

                data: {

                    labels: serviceAnalytics.labels,

                    datasets: serviceAnalytics.datasets.map(dataset => ({

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
                        intersect: false,
                        mode: 'index',
                    },

                    plugins: {

                        legend: {

                            display: true,
                            position: 'bottom',

                        },

                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return `${context.dataset.label}: ${context.parsed.y} kunjungan`;

                                }

                            }

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {
                                precision: 0,
                            },

                        },

                    },

                },

            });

        }

    </script>

</x-layout>