<x-layout>
    <x-slot:title>UNM Digital Hub</x-slot:title>

    <section class="relative z-10 pb-14 pt-10 sm:pb-20 sm:pt-16 lg:pb-24 lg:pt-20">
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute -right-32 top-0 size-80 rounded-full bg-blue-100/60 blur-3xl"></div>
            <div class="absolute -left-24 bottom-8 size-56 rounded-full bg-yellow-200/35 blur-3xl"></div>
        </div>

        <div class="relative grid items-center gap-12 lg:grid-cols-[1.12fr_.88fr] lg:gap-16">
            <div>
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-[#0F1B3D] shadow-sm">
                    <span class="size-2 rounded-full bg-[#FFC400]"></span>
                    UNM Digital Hub
                </div>
                <h1 class="max-w-3xl text-5xl font-semibold leading-[1.02] tracking-[-0.045em] text-[#0F1B3D] sm:text-6xl lg:text-7xl">
                    Cari semua layanan UNM<br class="hidden sm:block">
                    dalam <span class="relative whitespace-nowrap"><span class="relative z-10">satu tempat.</span><span class="absolute inset-x-0 bottom-1.5 -z-0 h-3 rounded-full bg-[#FFC400] sm:bottom-2 sm:h-4"></span></span>
                </h1>
                <p class="mt-7 max-w-2xl text-base leading-8 text-[#64748B] sm:text-lg">
                    Akses berbagai informasi, layanan, dan portal kampus Universitas Negeri Makassar dengan mudah dan cepat.
                </p>

                <div class="mt-8 max-w-3xl">
                    <livewire:global-search
                        :form-action="route('home')"
                        :initial-query="request('search')"
                        variant="hero"
                    />
                </div>
            </div>

        </div>
    </section>

    <section class="py-16 sm:py-20" aria-labelledby="services-heading">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#64748B]">{{ request()->filled('search') ? 'Hasil pencarian' : 'Paling sering diakses' }}</p>
                <h2 id="services-heading" class="mt-2 text-3xl font-semibold tracking-tight text-[#0F1B3D] sm:text-4xl">{{ request()->filled('search') ? 'Layanan yang ditemukan' : 'Layanan Populer' }}</h2>
            </div>
            @if (request()->filled('search'))
                <a href="{{ route('home') }}" class="text-sm font-semibold text-[#0F1B3D] hover:underline">Hapus pencarian</a>
            @endif
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($services as $item)
                <a href="{{ route('layanan.show', $item) }}" class="group flex min-h-72 flex-col rounded-[22px] border border-[#E2E8F0] bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] transition duration-300 hover:-translate-y-1.5 hover:border-[#FFC400] hover:shadow-[0_18px_45px_rgba(15,27,61,0.1)]">
                    <div class="flex size-14 items-center justify-center overflow-hidden rounded-2xl bg-slate-50 ring-1 ring-slate-100">
                        <img src="{{ Storage::url($item->logo ?: 'layanan-logo/logo-unm.png') }}" alt="" class="size-full object-contain p-2.5">
                    </div>
                    <div class="mt-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#64748B]">{{ $item->group?->nama_group ?? 'UNM' }}</p>
                        <h3 class="mt-2 text-xl font-semibold leading-snug text-[#0F1B3D]">{{ $item->nama_layanan }}</h3>
                        @if ($item->deskripsi)
                            <p class="mt-3 text-sm leading-6 text-[#64748B]">{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                    <span class="mt-auto inline-flex items-center gap-2 pt-7 text-sm font-semibold text-[#0F1B3D]">
                        Buka Layanan
                        <svg class="size-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </span>
                </a>
            @empty
                <div class="col-span-full rounded-[22px] border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                    <p class="font-semibold text-[#0F1B3D]">Tidak ada layanan yang cocok.</p>
                    <p class="mt-2 text-sm text-[#64748B]">Coba gunakan kata kunci lain.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-layout>
