<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="grid gap-5 lg:grid-cols-2">
        @forelse($kategori->groups as $group)
            @foreach($group->prodis as $prodi)
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 bg-slate-50 px-5 py-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">{{ $group->nama_group }}</p>
                        <h3 class="mt-1 text-lg font-bold text-slate-900">{{ $prodi->judul }}</h3>
                    </div>
                    <div class="divide-y divide-slate-100 px-5">
                        @foreach($prodi->links as $link)
                            <a href="{{ route('prodi-link.visit', $link) }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between gap-4 py-3.5 text-sm font-medium text-slate-700 hover:text-blue-700">
                                <span>{{ $link->label }} <small class="ml-1 font-normal text-slate-400">{{ $link->clicks }} klik</small></span><span class="text-blue-500 transition group-hover:translate-x-1">↗</span>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endforeach
        @empty
        @endforelse
    </div>

    @if($kategori->groups->sum(fn($group) => $group->prodis->count()) === 0)
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
            <p class="font-semibold text-slate-700">Portal prodi belum tersedia.</p>
            <p class="mt-1 text-sm text-slate-500">Silakan kembali lagi setelah pengelola menambahkan tautan.</p>
        </div>
    @endif
</x-layout>
