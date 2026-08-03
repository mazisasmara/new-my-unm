<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Edit Layanan</h1>

        <form
            action="{{ route('admin.layanan.update', $layanan) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4"
        >
            @csrf
            @method ('PUT')

            <div>
                <label class="block mb-1 font-medium"> Nama Layanan </label>

                <input
                    type="text"
                    name="nama_layanan"
                    value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                    class="w-full border rounded-lg px-3 py-2"
                />
            </div>

            <div>
                <label class="block mb-1 font-medium"> Deskripsi </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full border rounded-lg px-3 py-2"
                    >{{ old('deskripsi', $layanan->deskripsi) }}</textarea
                >
            </div>

            <div>
                <label class="block mb-1 font-medium"> Link </label>

                <input
                    type="url"
                    name="link"
                    value="{{ old('link', $layanan->link) }}"
                    class="w-full border rounded-lg px-3 py-2"
                />
            </div>

            <div>
                <label class="block mb-1 font-medium"> Logo Baru </label>

                <input
                    type="file"
                    name="logo"
                    class="w-full border rounded-lg px-3 py-2"
                />
            </div>

            @if ($layanan->logo)
                <div>
                    <p class="text-sm text-gray-500 mb-2">Logo Saat Ini</p>

                    <img
                        src="{{ asset('storage/' . $layanan->logo) }}"
                        class="size-16 rounded-full object-cover"
                    />
                </div>
            @endif

            <div>
                <label class="inline-flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        {{ $layanan->status ? 'checked' : '' }}
                    />

                    Aktif
                </label>
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg"
            >
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-layout>
