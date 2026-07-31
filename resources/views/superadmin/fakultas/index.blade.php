<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
  
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Kelola Fakultas</h1>
        <a href="{{ route('superadmin.admins.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">
            + Tambah Fakultas
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white rounded-lg shadow-sm text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">id</th>
                <th class="p-3">Nama Fakultas</th>
                <th class="p-3">Jumlah unit</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fakultas as $item)
                <tr class="border-b">
                    <td class="p-3">{{ $item->id }}</td>
                    <td class="p-3">{{ $item->nama_fakultas }}</td>
                    <td class="p-3">{{ $item->units_count }}</td>
                    <td class="p-3">
                        <form action="{{ route('superadmin.admins.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Hapus akun ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-layout>