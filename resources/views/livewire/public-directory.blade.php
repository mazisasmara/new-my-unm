<div wire:poll.visible.10s class="pb-16">
    @if ($kind === 'layanan')
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($kategori->groups as $directoryGroup)
                @foreach ($directoryGroup->layanans as $item)
                    <a href="{{ route('layanan.show', $item) }}" class="group flex min-h-72 flex-col rounded-[22px] border border-[#E2E8F0] bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] transition duration-300 hover:-translate-y-1.5 hover:border-[#FFC400] hover:shadow-[0_18px_45px_rgba(15,27,61,0.1)]">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex size-14 items-center justify-center overflow-hidden rounded-2xl bg-slate-50 ring-1 ring-slate-100">
                                <img src="{{ Storage::url($item->logo ?: 'layanan-logo/logo-unm.png') }}" alt="" class="size-full object-contain p-2.5">
                            </div>
                            @if ($item->clicks > 0)
                                <span class="rounded-full bg-yellow-50 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider text-amber-700">Populer</span>
                            @endif
                        </div>
                        <div class="mt-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#64748B]">{{ $directoryGroup->nama_group }}</p>
                            <h3 class="mt-2 text-xl font-semibold leading-snug text-[#0F1B3D]">{{ $item->nama_layanan }}</h3>
                            @if ($item->deskripsi)
                                <p class="mt-3 text-sm leading-6 text-[#64748B]">{{ $item->deskripsi }}</p>
                            @endif
                        </div>
                        <span class="mt-auto inline-flex items-center gap-2 pt-7 text-sm font-semibold text-[#0F1B3D]">Buka Layanan <svg class="size-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/></svg></span>
                    </a>
                @endforeach
            @empty
            @endforelse
        </div>

        @if ($kategori->groups->sum(fn ($directoryGroup) => $directoryGroup->layanans->count()) === 0)
            <div class="rounded-[22px] border border-dashed border-slate-300 bg-white p-12 text-center">
                <p class="font-semibold text-[#0F1B3D]">Layanan belum tersedia.</p>
                <p class="mt-1 text-sm text-[#64748B]">Coba ubah pencarian atau kembali lagi nanti.</p>
            </div>
        @endif
    @else
        <div class="grid gap-5 lg:grid-cols-2">
            @forelse($kategori->groups as $directoryGroup)
                @foreach ($directoryGroup->prodis as $prodi)
                    <section id="prodi-{{ $prodi->id }}" class="scroll-mt-28 overflow-hidden rounded-[22px] border border-slate-200 bg-white shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
                        <div class="border-b border-slate-100 bg-slate-50 px-6 py-5">
                            <p class="text-base font-bold uppercase leading-snug tracking-[0.08em] text-[#0F1B3D] sm:text-lg">{{ $directoryGroup->nama_group }}</p>
                            <h3 class="mt-1 text-lg font-semibold text-[#0F1B3D]">{{ $prodi->judul }}</h3>
                        </div>
                        <div class="divide-y divide-slate-100 px-6">
                            @foreach ($prodi->links as $link)
                                <a href="{{ route('prodi-link.visit', $link) }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between gap-4 py-4 text-sm font-medium text-slate-700 hover:text-[#0F1B3D]">
                                    <span>{{ $link->label }} <small class="ml-1 font-normal text-slate-400">{{ $link->clicks }} klik</small></span>
                                    <svg class="size-4 shrink-0 text-slate-400 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            @empty
            @endforelse
        </div>

        @if ($kategori->groups->sum(fn($directoryGroup) => $directoryGroup->prodis->count()) === 0)
            <div class="rounded-[22px] border border-dashed border-slate-300 bg-white p-12 text-center">
                <p class="font-semibold text-[#0F1B3D]">Portal prodi belum tersedia.</p>
                <p class="mt-1 text-sm text-[#64748B]">Silakan kembali lagi setelah pengelola menambahkan tautan.</p>
            </div>
        @endif
    @endif
</div>
