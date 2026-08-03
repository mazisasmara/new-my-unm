<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-1xl mx-auto py-5">
        <h1 class="text-2xl font-bold mb-6">Tambah Layanan</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.layanan.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4"
        >
            @csrf

            <div>
                <label class="block mb-1 font-medium"> Nama Layanan </label>

                <input
                    type="text"
                    name="nama_layanan"
                    class="w-full border rounded-lg p-2"
                    required
                />
            </div>

            <div>
                <label class="block mb-1 font-medium"> Deskripsi </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full border rounded-lg p-2"
                ></textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium"> Link </label>

                <input
                    type="url"
                    name="link"
                    class="w-full border rounded-lg p-2"
                />
            </div>

            <div>
                <label class="block mb-1 font-medium"> Logo </label>

                <input type="file" name="logo" class="w-full" />
            </div>

            <div>
                <label class="block mb-1 font-medium"> Status </label>

                <select name="status" class="w-full border rounded-lg p-2">
                    <option value="1">Aktif</option>

                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                Simpan
            </button>
        </form>
    </div>
</x-layout>
