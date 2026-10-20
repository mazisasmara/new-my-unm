<x-layout>
    <x-slot:title>UNM Digital Hub</x-slot:title>

    <section class="relative z-10 overflow-x-clip bg-[#F5F9FF] py-12 sm:py-16 lg:py-20">
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_77%_42%,rgba(191,219,254,0.6),transparent_26%),radial-gradient(circle_at_9%_84%,rgba(254,240,138,0.42),transparent_18%),linear-gradient(110deg,#f9fbff_0%,#eff6ff_52%,#f8fbff_100%)]"></div>
            <div class="absolute -right-28 top-1/2 size-80 -translate-y-1/2 rounded-full border-[18px] border-blue-200/35"></div>
            <div class="absolute -left-24 bottom-8 size-52 rounded-full border-[16px] border-yellow-200/45"></div>
            <div class="absolute left-[44%] top-12 size-3 rounded-full bg-[#FFC400]"></div>
            <div class="absolute right-[12%] top-16 size-2.5 rounded-full bg-blue-300"></div>
        </div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:min-h-[31rem] lg:grid-cols-[1.1fr_.9fr] lg:gap-10 lg:px-8">
            <div class="lg:py-4">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-[#0F1B3D] shadow-sm">
                    <span class="size-2 rounded-full bg-[#FFC400]"></span>
                    UNM Digital Hub
                </div>
                <h1 class="max-w-2xl text-4xl font-semibold leading-[1.06] tracking-[-0.045em] text-[#0F1B3D] sm:text-5xl lg:text-[3.45rem] xl:text-6xl">
                    Cari semua layanan UNM<br class="hidden sm:block">
                    dalam <span class="relative whitespace-nowrap"><span class="relative z-10">satu tempat.</span><span class="absolute inset-x-0 bottom-1.5 -z-0 h-3 rounded-full bg-[#FFC400] sm:bottom-2 sm:h-4"></span></span>
                </h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-[#64748B] sm:text-lg">
                    Akses berbagai informasi, layanan, dan portal kampus Universitas Negeri Makassar dengan mudah dan cepat.
                </p>

                <div class="mt-8 max-w-xl">
                    <livewire:global-search
                        :form-action="route('home')"
                        :initial-query="request('search')"
                        variant="hero"
                    />
                </div>
            </div>

            <div class="mx-auto w-full max-w-xl lg:max-w-[32rem]" aria-label="Akses cepat layanan UNM">
                <div class="relative isolate rounded-[2rem] border border-blue-100/80 bg-white/35 p-5 shadow-[0_20px_60px_rgba(30,64,175,0.08)] sm:p-7 lg:aspect-[1.12] lg:p-0">
                    <div class="pointer-events-none absolute left-1/2 top-1/2 hidden size-[54%] -translate-x-1/2 -translate-y-1/2 rounded-full border border-blue-200/80 bg-white/45 lg:block"></div>
                    <div class="pointer-events-none absolute left-1/2 top-1/2 hidden size-[43%] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-blue-100/90 via-white to-yellow-100/70 lg:block"></div>
                    <svg class="pointer-events-none absolute inset-[8%] hidden h-[84%] w-[84%] lg:block" viewBox="0 0 440 390" fill="none" aria-hidden="true">
                        <path d="M96 89C144 101 163 124 220 166M220 166C273 118 309 104 350 92M220 166C172 230 145 264 97 290M220 166C267 231 300 264 353 289" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-dasharray="5 8" opacity=".62"/>
                        <path d="M96 89C141 149 179 165 220 166M220 166C264 173 313 143 350 92M220 166C239 229 280 270 353 289" stroke="#FFC400" stroke-width="2.5" stroke-linecap="round" opacity=".92"/>
                    </svg>

                    <div class="relative grid gap-4 sm:grid-cols-2 lg:block">
                        <article class="rounded-[1.35rem] border border-white/95 bg-white/95 p-4 shadow-[0_14px_32px_rgba(15,27,61,0.12)] backdrop-blur sm:p-5 lg:absolute lg:left-[7%] lg:top-[14%] lg:w-[39%] lg:-rotate-[3deg]">
                            <div class="flex size-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 sm:size-11">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10.5 12 5l9 5.5M5.5 12v5.5m4-5.5v5.5m4-5.5v5.5m4-5.5v5.5M3 20h18"/></svg>
                        </div>
                        <p class="mt-3 text-sm font-bold leading-snug text-[#0F1B3D]">Akademik</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">Informasi akademik terkini</p>
                        <div class="mt-3 flex items-center gap-1.5" aria-hidden="true"><span class="size-1.5 rounded-full bg-blue-500"></span><span class="h-1.5 w-12 rounded-full bg-blue-100"></span><span class="h-1.5 flex-1 rounded-full bg-slate-100"></span></div>
                    </article>

                    <article class="rounded-[1.35rem] border border-white/95 bg-white/95 p-4 shadow-[0_14px_32px_rgba(15,27,61,0.12)] backdrop-blur sm:p-5 lg:absolute lg:right-[7%] lg:top-[14%] lg:w-[39%] lg:rotate-[3deg]">
                        <div class="flex size-10 items-center justify-center rounded-xl bg-[#FFF4C7] text-[#A36C00] sm:size-11">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 0 0-8 0v2m4-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8 9v-2a4 4 0 0 0-3-3.87M18 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <p class="mt-3 text-sm font-bold leading-snug text-[#0F1B3D]">Portal Mahasiswa</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">Kebutuhan mahasiswa dalam satu portal</p>
                        <div class="mt-3 flex items-center gap-1.5" aria-hidden="true"><span class="size-1.5 rounded-full bg-[#FFC400]"></span><span class="h-1.5 w-10 rounded-full bg-yellow-100"></span><span class="h-1.5 flex-1 rounded-full bg-slate-100"></span></div>
                    </article>

                    <div class="absolute left-1/2 top-1/2 z-10 hidden size-28 -translate-x-1/2 -translate-y-1/2 flex-col items-center justify-center rounded-full border-4 border-white bg-white p-2 shadow-[0_12px_30px_rgba(15,27,61,0.18)] lg:flex">
                        <img src="{{ asset('storage/layanan-logo/logo-unm.png') }}" alt="Logo Universitas Negeri Makassar" class="size-16 object-contain">
                        <span class="-mt-1 text-[7px] font-bold tracking-[0.16em] text-[#0F1B3D]">DIGITAL HUB</span>
                    </div>

                    <article class="rounded-[1.35rem] border border-white/95 bg-white/95 p-4 shadow-[0_14px_32px_rgba(15,27,61,0.12)] backdrop-blur sm:p-5 lg:absolute lg:bottom-[14%] lg:left-[7%] lg:w-[39%] lg:rotate-[2deg]">
                        <div class="flex size-10 items-center justify-center rounded-xl bg-[#E4EEFF] text-[#1D4ED8] sm:size-11">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6 3h14v18H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm3 4h7m-7 4h7"/></svg>
                        </div>
                        <p class="mt-3 text-sm font-bold leading-snug text-[#0F1B3D]">Perpustakaan Digital</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">Koleksi ilmu tanpa batas</p>
                        <div class="mt-3 flex items-center gap-1.5" aria-hidden="true"><span class="size-1.5 rounded-full bg-blue-500"></span><span class="h-1.5 w-14 rounded-full bg-blue-100"></span><span class="h-1.5 flex-1 rounded-full bg-slate-100"></span></div>
                    </article>

                    <article class="rounded-[1.35rem] border border-white/95 bg-white/95 p-4 shadow-[0_14px_32px_rgba(15,27,61,0.12)] backdrop-blur sm:p-5 lg:absolute lg:bottom-[14%] lg:right-[7%] lg:w-[39%] lg:-rotate-[2deg]">
                        <div class="flex size-10 items-center justify-center rounded-xl bg-[#FFF4C7] text-[#A36C00] sm:size-11">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V10l7-5 7 5v11M9 21v-6h6v6"/></svg>
                        </div>
                        <p class="mt-3 text-sm font-bold leading-snug text-[#0F1B3D]">Fakultas &amp; Prodi</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">Temukan pilihan studi Anda</p>
                        <div class="mt-3 flex items-center gap-1.5" aria-hidden="true"><span class="size-1.5 rounded-full bg-[#FFC400]"></span><span class="h-1.5 w-11 rounded-full bg-yellow-100"></span><span class="h-1.5 flex-1 rounded-full bg-slate-100"></span></div>
                    </article>
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
                            <p class="mt-3 text-sm leading-6 text-[#64748B]">{{ Str::limit($item->deskripsi, 110) }}</p>
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
