<x-layout>
      <x-slot:title>{{ $title }}</x-slot:title>

<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Dashboard Superadmin</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <p class="text-sm text-gray-500">Total Users</p>
            <p class="text-2xl font-bold">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <p class="text-sm text-gray-500">Total Admin</p>
            <p class="text-2xl font-bold">{{ $stats['total_admin'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <p class="text-sm text-gray-500">Layanan Aktif</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['layanan_aktif'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <p class="text-sm text-gray-500">Layanan Nonaktif</p>
            <p class="text-2xl font-bold text-gray-400">{{ $stats['layanan_nonaktif'] }}</p>
        </div>
    </div>

    <h2 class="font-semibold text-lg mb-3">Semua Layanan</h2>
    <table class="w-full bg-white rounded-lg shadow-sm text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Nama</th>
                <th class="p-3">Fakultas</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($layananList as $item)
                <tr class="border-b">
                    <td class="p-3">{{ $item->nama_layanan }}</td>
                    <td class="p-3">{{ $item->unit->fakultas->nama_fakultas ?? '-' }}</td>
                    <td class="p-3">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="p-3">{{ $item->status ? 'Aktif' : 'Nonaktif' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('superadmin.admins.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">
        Kelola Akun Admin →
    </a>
</div>
</x-layout>