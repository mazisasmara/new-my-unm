@php($editing = isset($prodi))
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mx-auto max-w-3xl">
        @if($errors->any())<div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700"><p class="font-semibold">Periksa kembali data berikut:</p><ul class="mt-2 list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form action="{{ $editing ? route('admin.prodi.update', $prodi) : route('admin.prodi.store') }}" method="POST" class="space-y-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
            @csrf @if($editing) @method('PUT') @endif
            @if(auth()->user()->isSuperAdmin())
                <div><label class="mb-1.5 block text-sm font-semibold">Pemilik / Grup Portal</label><select name="group_id" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"><option value="">Pilih grup portal</option>@foreach($groups as $group)<option value="{{ $group->id }}" @selected(old('group_id', $prodi->group_id ?? '') == $group->id)>{{ $group->nama_group }} ({{ $group->user?->username ?? 'tanpa admin' }})</option>@endforeach</select></div>
            @endif
            <div><label for="judul" class="mb-1.5 block text-sm font-semibold">Judul Prodi</label><input id="judul" name="judul" value="{{ old('judul', $prodi->judul ?? '') }}" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5" placeholder="Contoh: Program Studi Teknik Informatika"></div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div><label for="urutan" class="mb-1.5 block text-sm font-semibold">Urutan</label><input id="urutan" type="number" min="0" name="urutan" value="{{ old('urutan', $prodi->urutan ?? 0) }}" class="w-full rounded-xl border border-slate-300 px-3 py-2.5"></div>
                <label class="mt-7 flex items-center gap-3"><input type="checkbox" name="status" value="1" class="size-4 rounded" @checked(old('status', $prodi->status ?? true))><span class="text-sm font-semibold">Tampilkan di halaman publik</span></label>
            </div>
            <div>
                <div class="mb-3 flex items-center justify-between"><div><h3 class="font-bold">Daftar Tautan</h3><p class="text-sm text-slate-500">Setiap prodi wajib memiliki minimal satu tautan.</p></div><button type="button" onclick="addLink()" class="rounded-lg border border-blue-200 px-3 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">+ Tautan</button></div>
                <div id="links" class="space-y-3">
                    @php($links = old('links', $editing ? $prodi->links->map->only(['id', 'label', 'url'])->all() : [['label' => '', 'url' => '']]))
                    @foreach($links as $index => $link)
                        <div class="link-row grid gap-2 rounded-xl bg-slate-50 p-3 sm:grid-cols-[1fr_1.5fr_auto]">
                            @if(isset($link['id']))<input type="hidden" name="links[{{ $index }}][id]" value="{{ $link['id'] }}">@endif
                            <input name="links[{{ $index }}][label]" value="{{ $link['label'] }}" required class="rounded-lg border border-slate-300 px-3 py-2" placeholder="Nama tautan">
                            <input type="url" name="links[{{ $index }}][url]" value="{{ $link['url'] }}" required class="rounded-lg border border-slate-300 px-3 py-2" placeholder="https://...">
                            <button type="button" onclick="removeLink(this)" class="rounded-lg px-3 py-2 text-red-600 hover:bg-red-50" aria-label="Hapus tautan">Hapus</button>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5"><a href="{{ route('admin.prodi.index') }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold">Batal</a><button class="rounded-xl bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">Simpan</button></div>
        </form>
    </div>
    <template id="link-template"><div class="link-row grid gap-2 rounded-xl bg-slate-50 p-3 sm:grid-cols-[1fr_1.5fr_auto]"><input data-name="label" required class="rounded-lg border border-slate-300 px-3 py-2" placeholder="Nama tautan"><input data-name="url" type="url" required class="rounded-lg border border-slate-300 px-3 py-2" placeholder="https://..."><button type="button" onclick="removeLink(this)" class="rounded-lg px-3 py-2 text-red-600 hover:bg-red-50">Hapus</button></div></template>
    <script>
        function reindexLinks() { document.querySelectorAll('.link-row').forEach((row, index) => row.querySelectorAll('input').forEach(input => { const field = input.dataset.name || input.name.match(/\[(id|label|url)\]/)?.[1]; input.name = `links[${index}][${field}]`; })); }
        function addLink() { document.getElementById('links').append(document.getElementById('link-template').content.cloneNode(true)); reindexLinks(); }
        function removeLink(button) { if (document.querySelectorAll('.link-row').length > 1) { button.closest('.link-row').remove(); reindexLinks(); } }
    </script>
</x-layout>
