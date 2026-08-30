<x-layout>
    <x-slot:title>{{ auth()->user()->isSuperAdmin() ? 'Seluruh Layanan' : $title }}</x-slot:title>
    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div><h2 class="font-bold text-slate-800">Daftar Layanan</h2><p class="text-sm text-slate-500">{{ auth()->user()->isSuperAdmin() ? 'Kelola layanan dari seluruh unit dan lihat penanggung jawabnya.' : 'Kelola layanan milik '.auth()->user()->group->nama_group.'.' }}</p></div>
            <a href="{{ route('admin.layanan.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-blue-700">+ Tambah Layanan</a>
        </div>
        @if(session('success'))<div class="m-5 rounded-md border border-green-200 bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>@endif
        <form method="GET" class="grid gap-3 border-b border-slate-200 p-4 sm:grid-cols-2 lg:grid-cols-5">
            <input name="search" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi..." class="rounded-md border border-slate-300 px-3 py-2 text-sm lg:col-span-2">
            @if(auth()->user()->isSuperAdmin())
                <select name="kategori" class="rounded-md border border-slate-300 px-3 py-2 text-sm"><option value="">Semua kategori</option>@foreach($kategoris as $kategori)<option value="{{ $kategori->id }}" @selected(request('kategori') == $kategori->id)>{{ $kategori->nama_kategori }}</option>@endforeach</select>
                <select name="group" class="rounded-md border border-slate-300 px-3 py-2 text-sm"><option value="">Semua grup</option>@foreach($groups as $group)<option value="{{ $group->id }}" @selected(request('group') == $group->id)>{{ $group->nama_group }}</option>@endforeach</select>
            @endif
            <select name="status" class="rounded-md border border-slate-300 px-3 py-2 text-sm"><option value="">Semua status</option><option value="1" @selected(request('status') === '1')>Aktif</option><option value="0" @selected(request('status') === '0')>Nonaktif</option></select>
            <div class="flex gap-2 {{ auth()->user()->isSuperAdmin() ? 'lg:col-span-5 lg:justify-end' : '' }}"><button class="rounded-md bg-slate-700 px-4 py-2 text-sm font-semibold text-white">Filter</button><a href="{{ route('admin.layanan.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold">Reset</a></div>
        </form>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase text-slate-500"><tr><th class="px-4 py-3">Layanan</th>@if(auth()->user()->isSuperAdmin())<th class="px-4 py-3">Pemilik</th><th class="px-4 py-3">Dibuat oleh</th>@endif<th class="px-4 py-3">Klik</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Aksi</th></tr></thead>
                <tbody id="sortable" class="divide-y divide-slate-100">
                    @forelse($layanans as $item)
                        <tr data-id="{{ $item->id }}" class="hover:bg-slate-50">
                            <td class="px-4 py-3"><div class="flex items-center gap-3"><span class="cursor-move text-slate-400">☰</span><img src="{{ Storage::url($item->logo ?: 'layanan-logo/gambar.png') }}" class="size-10 rounded-md border object-contain" alt=""><div><p class="font-semibold text-slate-800">{{ $item->nama_layanan }}</p><p class="text-xs text-slate-500">{{ $item->group?->kategori?->nama_kategori }}</p></div></div></td>
                            @if(auth()->user()->isSuperAdmin())<td class="px-4 py-3"><p class="font-medium">{{ $item->group?->nama_group ?? '-' }}</p><p class="text-xs text-slate-500">Admin: {{ $item->group?->user?->username ?? 'belum ditugaskan' }}</p></td><td class="px-4 py-3 text-slate-600">{{ $item->creator?->username ?? '-' }}</td>@endif
                            <td class="px-4 py-3 font-semibold">{{ number_format($item->clicks) }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">{{ $item->status ? 'Aktif' : 'Nonaktif' }}</span></td>
                            <td class="px-4 py-3"><div class="flex justify-end gap-2"><form action="{{ route('admin.layanan.toggle', $item) }}" method="POST">@csrf @method('PATCH')<button class="rounded border border-slate-300 px-2.5 py-1.5 text-xs font-semibold">{{ $item->status ? 'Nonaktifkan' : 'Aktifkan' }}</button></form><a href="{{ route('admin.layanan.edit', $item) }}" class="rounded bg-amber-500 px-2.5 py-1.5 text-xs font-semibold text-white">Edit</a><form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">@csrf @method('DELETE')<button class="rounded bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white">Hapus</button></form></div></td>
                        </tr>
                    @empty<tr><td colspan="{{ auth()->user()->isSuperAdmin() ? 6 : 4 }}" class="px-5 py-12 text-center text-slate-500">Tidak ada layanan yang sesuai dengan filter.</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
    @unless(auth()->user()->isSuperAdmin())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
        <script>new Sortable(document.getElementById('sortable'), { animation: 150, onEnd() { const ids = Array.from(document.querySelectorAll('#sortable tr[data-id]')).map(item => item.dataset.id); fetch('{{ route('admin.layanan.reorder') }}', { method: 'POST', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'}, body: JSON.stringify({ids}) }); } });</script>
    @endunless
</x-layout>
