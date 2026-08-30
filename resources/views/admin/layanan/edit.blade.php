<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="mx-auto max-w-3xl">
        <div class="rounded-t-lg border border-slate-200 bg-slate-50 px-6 py-4"><h2 class="text-lg font-bold text-slate-800">Edit Informasi Layanan</h2><p class="text-sm text-slate-500">Perbarui data, pemilik, dan status layanan.</p></div>

        <form
            action="{{ route('admin.layanan.update', $layanan) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5 rounded-b-lg border border-t-0 border-slate-200 bg-white p-6 shadow-sm"
        >
            @csrf
            @method ('PUT')

            @if(auth()->user()->isSuperAdmin())
                <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Pemilik / Grup</label><select name="group_id" required class="w-full rounded-md border border-slate-300 px-3 py-2.5">@foreach($groups as $group)<option value="{{ $group->id }}" @selected(old('group_id', $layanan->group_id) == $group->id)>{{ $group->nama_group }} · {{ $group->kategori->nama_kategori }} ({{ $group->user?->username ?? 'tanpa admin' }})</option>@endforeach</select></div>
            @endif

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

            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5"><a href="{{ route('admin.layanan.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a><button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white">Simpan Perubahan</button></div>
        </form>
    </div>
</x-layout>
