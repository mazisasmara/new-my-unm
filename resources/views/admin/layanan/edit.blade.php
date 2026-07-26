<x-layout>
      <x-slot:title>{{ $title }}</x-slot:title>

<div class="max-w-lg mx-auto py-8 px-4">
    <h1 class="text-xl font-bold mb-6">Edit Layanan</h1>

    <form action="{{ route('admin.layanan.update', $layanan) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Layanan</label>
            <input type="text" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                class="w-full border rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded-md p-2" rows="3">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Link</label>
            <input type="url" name="link" value="{{ old('link', $layanan->link) }}" class="w-full border rounded-md p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Logo</label>
            @if ($layanan->logo)
                <img src="{{ Storage::url($layanan->logo) }}" class="h-12 mb-2">
            @endif
            <input type="file" name="logo" class="w-full">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
</x-layout>