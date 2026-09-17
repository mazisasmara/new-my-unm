<x-layout>
    <x-slot:title>{{ auth()->user()->isSuperAdmin() ? 'Seluruh Portal Prodi' : $title }}</x-slot:title>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div><h2 class="text-xl font-bold text-slate-900">Daftar Portal Prodi</h2><p class="text-sm text-slate-500">{{ auth()->user()->isSuperAdmin() ? 'Kelola seluruh portal prodi beserta unit pemiliknya.' : 'Kelola judul dan kumpulan tautan untuk '.auth()->user()->group->nama_group.'.' }}</p></div>
        <a href="{{ route('admin.prodi.create') }}" class="rounded-xl bg-yellow-400 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-800">+ Tambah Prodi</a>
    </div>
    @if(session('success'))<div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('success') }}</div>@endif
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <form method="GET" class="grid gap-3 border-b border-slate-200 bg-slate-50 p-4 sm:grid-cols-2 lg:grid-cols-4">
            <input name="search" value="{{ request('search') }}" placeholder="Cari judul atau nama tautan..." class="rounded-md border border-slate-300 px-3 py-2 text-sm lg:col-span-2">
            @if(auth()->user()->isSuperAdmin())<select name="group" class="rounded-md border border-slate-300 px-3 py-2 text-sm"><option value="">Semua grup</option>@foreach($groups as $group)<option value="{{ $group->id }}" @selected(request('group') == $group->id)>{{ $group->nama_group }}</option>@endforeach</select>@endif
            <select name="status" class="rounded-md border border-slate-300 px-3 py-2 text-sm"><option value="">Semua status</option><option value="1" @selected(request('status') === '1')>Aktif</option><option value="0" @selected(request('status') === '0')>Nonaktif</option></select>
            <div class="flex gap-2 lg:col-span-4 lg:justify-end"><button class="rounded-md bg-slate-700 px-4 py-2 text-sm font-semibold text-white">Filter</button><a href="{{ route('admin.prodi.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold">Reset</a></div>
        </form>
        <livewire:managed-prodi-list :search="request('search')" :status="request('status')" :group="request('group')" />
    </div>
</x-layout>
