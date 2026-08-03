<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Dashboard Superadmin</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
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
        <a
            href="{{ route('superadmin.admins.index') }}"
            class="inline-block mt-6 text-blue-600 hover:underline"
        >
            Kelola Akun Admin →
        </a>
        <div class="flex justify-end items-center gap-2 mb-4">
            <form>
                <label class="text-sm text-gray-600"> Filter: </label>
                <select
                    name="kategori"
                    onchange="this.form.submit()"
                    class="border rounded-lg px-3 py-2"
                >
                    <option value="">Semua Kategori</option>

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

        <x-search></x-search>

        <table class="w-full bg-white rounded-lg shadow-sm text-sm mb-5">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-3">ID</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Logo</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">di Click</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layananList as $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item->id }}</td>
                        <td class="p-3">{{ $item->nama_layanan }}</td>
                        <td class="p-3">
                            <img
                                src="{{ asset('/logo/gambar.png') }}"
                                alt="logo"
                                class="size-8 rounded-full"
                            />
                        </td>
                        <td class="p-3">
                            {{ $item->group->kategori->nama_kategori ?? '-' }}
                        </td>
                        <td class="p-3">{{ $item->clicks }}</td>
                        <td class="p-3">
                            {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                        </td>
                        <td class="p-3">
                            {{ $item->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="font-semibold text-lg mb-3">Semua Group</h2>

        <table class="w-full bg-white rounded-lg shadow-sm text-sm mb-5">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-3">ID</th>
                    <th class="p-3">Nama Group</th>
                    <th class="p-3">Username pemilik</th>
                    <th class="p-3">Slug</th>
                    <th class="p-3">Urutan</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item->id }}</td>
                        <td class="p-3">{{ $item->nama_group }}</td>
                        <td class="p-3">
                            {{ $item->user->username ?? 'Tidak ditemukan' }}
                        </td>
                        <td class="p-3">{{ $item->slug }}</td>
                        <td class="p-3">{{ $item->urutan }}</td>
                        <td class="p-3">
                            {{ $item->status ? 'aktif' : 'Nonaktif' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
