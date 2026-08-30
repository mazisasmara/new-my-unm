<x-layout>
    <x-slot:title>{{ auth()->user()->isSuperAdmin() ? 'Seluruh Portal Prodi' : $title }}</x-slot:title>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div><h2 class="text-xl font-bold text-slate-900">Daftar Portal Prodi</h2><p class="text-sm text-slate-500">{{ auth()->user()->isSuperAdmin() ? 'Kelola seluruh portal prodi beserta unit pemiliknya.' : 'Kelola judul dan kumpulan tautan untuk '.auth()->user()->group->nama_group.'.' }}</p></div>
        <a href="{{ route('admin.prodi.create') }}" class="rounded-xl bg-blue-700 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-800">+ Tambah Prodi</a>
    </div>
    @if(session('success'))<div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('success') }}</div>@endif
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <form method="GET" class="grid gap-3 border-b border-slate-200 bg-slate-50 p-4 sm:grid-cols-2 lg:grid-cols-4">
            <input name="search" value="{{ request('search') }}" placeholder="Cari judul atau nama tautan..." class="rounded-md border border-slate-300 px-3 py-2 text-sm lg:col-span-2">
            @if(auth()->user()->isSuperAdmin())<select name="group" class="rounded-md border border-slate-300 px-3 py-2 text-sm"><option value="">Semua grup</option>@foreach($groups as $group)<option value="{{ $group->id }}" @selected(request('group') == $group->id)>{{ $group->nama_group }}</option>@endforeach</select>@endif
            <select name="status" class="rounded-md border border-slate-300 px-3 py-2 text-sm"><option value="">Semua status</option><option value="1" @selected(request('status') === '1')>Aktif</option><option value="0" @selected(request('status') === '0')>Nonaktif</option></select>
            <div class="flex gap-2 lg:col-span-4 lg:justify-end"><button class="rounded-md bg-slate-700 px-4 py-2 text-sm font-semibold text-white">Filter</button><a href="{{ route('admin.prodi.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold">Reset</a></div>
        </form>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-5 py-3">Judul</th>@if(auth()->user()->isSuperAdmin())<th class="px-5 py-3">Pemilik</th>@endif<th class="px-5 py-3">Tautan dan Klik</th><th class="px-5 py-3">Total Klik</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Aksi</th></tr></thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($prodis as $prodi)
                        <tr><td class="px-5 py-4 font-semibold text-slate-800">{{ $prodi->judul }}</td>@if(auth()->user()->isSuperAdmin())<td class="px-5 py-4"><p class="font-medium">{{ $prodi->group?->nama_group ?? '-' }}</p><p class="text-xs text-slate-500">Admin: {{ $prodi->group?->user?->username ?? 'belum ditugaskan' }} · Pembuat: {{ $prodi->creator?->username ?? '-' }}</p></td>@endif<td class="px-5 py-4 text-slate-500"><ul class="space-y-1">@foreach($prodi->links as $link)<li>{{ $link->label }} <span class="text-xs text-blue-700">({{ $link->clicks }} klik)</span></li>@endforeach</ul></td><td class="px-5 py-4 font-bold text-slate-700">{{ $prodi->links->sum('clicks') }}</td><td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $prodi->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $prodi->status ? 'Aktif' : 'Nonaktif' }}</span></td><td class="px-5 py-4"><div class="flex justify-end gap-3"><a href="{{ route('admin.prodi.edit', $prodi) }}" class="rounded bg-amber-500 px-2.5 py-1.5 text-xs font-semibold text-white">Edit</a><form action="{{ route('admin.prodi.destroy', $prodi) }}" method="POST" onsubmit="return confirm('Hapus portal prodi ini?')">@csrf @method('DELETE')<button class="rounded bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white">Hapus</button></form></div></td></tr>
                    @empty
                        <tr><td colspan="{{ auth()->user()->isSuperAdmin() ? 6 : 5 }}" class="px-5 py-12 text-center text-slate-500">Tidak ada Portal Prodi yang sesuai dengan filter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
