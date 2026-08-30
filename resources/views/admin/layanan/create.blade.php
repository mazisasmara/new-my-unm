<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="mx-auto max-w-3xl">
        <div class="mb-4 border-b border-slate-200 bg-slate-50 px-6 py-4"><h2 class="text-lg font-bold text-slate-800">Informasi Layanan</h2><p class="text-sm text-slate-500">Lengkapi informasi layanan yang akan dipublikasikan.</p></div>

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
            class="space-y-5 rounded-b-lg border border-t-0 border-slate-200 bg-white p-6 shadow-sm"
        >
            @csrf

            @if(auth()->user()->isSuperAdmin())
                <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Pemilik / Grup</label><select name="group_id" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"><option value="">Pilih grup</option>@foreach($groups as $group)<option value="{{ $group->id }}" @selected(old('group_id') == $group->id)>{{ $group->nama_group }} · {{ $group->kategori->nama_kategori }} ({{ $group->user?->username ?? 'tanpa admin' }})</option>@endforeach</select></div>
            @endif

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

            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5"><a href="{{ route('admin.layanan.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a><button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Simpan</button></div>
        </form>
    </div>
</x-layout>
