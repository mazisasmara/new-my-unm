<div wire:poll.visible.10s>
@if($kind === 'layanan')
    <div class="relative z-10 px-6 pb-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($kategori->groups as $group)
                @foreach ($group->layanans as $item)
                    <a href="{{ route('layanan.show', $item) }}" class="group relative flex min-h-[370px] overflow-hidden rounded-[42px] border border-white/10 bg-black/35 shadow-xl backdrop-blur-[2px] transition-all duration-300 hover:-translate-y-2 hover:bg-black/45 hover:shadow-2xl">
                        <div class="relative flex w-full min-h-[370px] flex-col p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex h-[100px] w-[100px] shrink-0 items-center justify-center overflow-hidden rounded-full bg-gray-200">
                                    <img src="{{ Storage::url($item->logo ?: 'layanan-logo/logo-unm.png') }}" alt="Logo {{ $item->nama_layanan }}" class="size-full object-contain p-2">
                                </div>
                            </div>

                            <div class="mt-12 text-center">
                                <h3 class="line-clamp-1 text-2xl font-normal uppercase tracking-tight text-white">{{ $item->nama_layanan }}</h3>
                                <p class="mt-2 line-clamp-2 px-1 text-sm uppercase leading-tight text-white">{{ $item->creator?->username }}</p>
                                <p class="mt-1 line-clamp-2 px-3 text-sm leading-tight text-white">{{ $item->deskripsi }}</p>
                            </div>

                            <div class="mt-auto pt-5">
                                <div class="flex justify-center"><span class="inline-flex h-10 w-28 items-center justify-center rounded-full bg-gray-200 text-sm font-medium text-gray-800 transition group-hover:bg-white">Lihat</span></div>
                                @if ($item->clicks > 0)
                                    <div class="mt-5 flex items-center justify-center gap-2 text-center"><span class="text-lg text-red-500">•</span><span class="text-xs font-semibold text-white">paling sering dikunjungi</span></div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>
@else
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
@endif
</div>
