<x-layout>
    <x-slot:title>UNM Digital Hub</x-slot:title>

    
<section class="relative isolate overflow-hidden bg-[#F7FAFF]">
    {{-- Background dekorasi --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_75%_42%,rgba(191,219,254,0.48),transparent_35%),linear-gradient(115deg,#FBFDFF_0%,#F1F6FF_55%,#F8FBFF_100%)]"></div>

        <div class="absolute -right-28 -top-24 size-80 rounded-full bg-blue-100/60 blur-3xl"></div>
        <div class="absolute -left-28 bottom-[-7rem] size-80 rounded-full bg-yellow-100/70 blur-3xl"></div>

        <div class="absolute left-[54%] top-[29%] size-3 rounded-full bg-[#FFC400]"></div>
        <div class="absolute right-[18%] top-[18%] size-4 rounded-full bg-[#FFC400]"></div>
        <div class="absolute right-[7%] top-[52%] size-3 rounded-full bg-[#FFC400]"></div>
        <div class="absolute left-[57%] bottom-[24%] size-4 rotate-45 rounded bg-yellow-300"></div>
    </div>

    <div class="mx-auto grid min-h-[650px] max-w-[1440px] items-center gap-12 px-5 py-16 sm:px-8 sm:py-20 lg:min-h-[760px] lg:grid-cols-[1.08fr_.92fr] lg:gap-8 lg:px-12 xl:px-16">

        {{-- Kolom kiri --}}
        <div class="relative z-10 max-w-[680px]">
            <div class="mb-8 inline-flex items-center gap-3 rounded-full border border-blue-100 bg-white/90 px-5 py-3 shadow-[0_3px_8px_rgba(15,27,61,0.08)]">
                <span class="size-3.5 rounded-full bg-[#FFC400]"></span>
                <span class="text-xs font-extrabold uppercase tracking-[0.2em] text-[#0F1B3D] sm:text-sm">
                    UNM DIGITAL HUB
                </span>
            </div>

            <h1 class="max-w-[700px] text-[clamp(2.7rem,5.1vw,5.2rem)] font-bold leading-[1.02] tracking-[-0.055em] text-[#0F1B3D]">
                Cari semua layanan UNM dalam
                <span class="relative inline-block whitespace-nowrap">
                    <span class="relative z-10">satu tempat.</span>
                    <span class="absolute -bottom-1 left-0 right-0 z-0 h-2.5 rounded-full bg-[#FFC400] sm:h-3.5"></span>
                </span>
            </h1>

            <p class="mt-8 max-w-[580px] text-base leading-8 text-[#647DAA] sm:text-lg">
                Akses berbagai informasi, layanan, dan portal kampus Universitas Negeri Makassar dengan mudah dan cepat.
            </p>

            {{-- Pencarian Livewire tetap dipertahankan --}}
            <div class="mt-9 max-w-[720px]">
                <livewire:global-search
                    :form-action="route('home')"
                    :initial-query="request('search')"
                    variant="hero"
                />
            </div>
        </div>

        {{-- Kolom kanan: ilustrasi layanan --}}
        <div class="relative mx-auto w-full max-w-[620px] lg:ml-auto lg:mr-0">

            {{-- Lingkaran dekoratif --}}
            <div class="pointer-events-none absolute left-1/2 top-1/2 size-[76%] -translate-x-1/2 -translate-y-1/2 rounded-full border border-blue-200/60 bg-blue-100/25"></div>
            <div class="pointer-events-none absolute left-1/2 top-1/2 size-[57%] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-blue-100/90 via-white/80 to-yellow-100/60"></div>

            {{-- Garis penghubung --}}
            <svg class="pointer-events-none absolute inset-0 z-0 h-full w-full" viewBox="0 0 600 580" fill="none" aria-hidden="true">
                <path d="M155 115 C250 115 215 210 300 235 S420 170 475 120"
                    stroke="#FFC400" stroke-width="4" stroke-linecap="round"/>
                <path d="M300 235 C230 270 220 345 130 385"
                    stroke="#3978FF" stroke-width="4" stroke-linecap="round"/>
                <path d="M300 235 C390 270 390 345 485 400"
                    stroke="#FFC400" stroke-width="4" stroke-linecap="round"/>
                <path d="M130 385 C200 430 240 445 300 425"
                    stroke="#3978FF" stroke-width="4" stroke-linecap="round"/>
                <path d="M300 425 C370 435 425 420 485 400"
                    stroke="#3978FF" stroke-width="4" stroke-linecap="round"/>

                <circle cx="155" cy="115" r="6" fill="#FFC400"/>
                <circle cx="475" cy="120" r="6" fill="#FFC400"/>
                <circle cx="130" cy="385" r="6" fill="#FFC400"/>
                <circle cx="485" cy="400" r="6" fill="#FFC400"/>
            </svg>

            <div class="relative z-10 grid grid-cols-2 gap-4 sm:gap-6 lg:aspect-[1/1.02] lg:block">

                {{-- Akademik --}}
                <article class="rounded-[24px] border border-white bg-white/95 p-4 shadow-[0_18px_40px_rgba(37,99,235,0.12)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 sm:p-5 lg:absolute lg:left-[%] lg:top-[2%] lg:w-[43%] lg:-rotate-[4deg]">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex size-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 sm:size-14">
                            <svg class="size-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9l9-5 9 5-9 5-9-5Zm4 3v5c3 2.5 7 2.5 10 0v-5M21 9v6"/>
                            </svg>
                        </div>
                        <span class="flex size-9 items-center justify-center rounded-full bg-yellow-50 text-[#EFA900]">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/>
                            </svg>
                        </span>
                    </div>
                    <h3 class="mt-3 text-base font-bold text-[#0F1B3D] sm:text-lg">Akademik</h3>
                    <p class="mt-1 text-xs leading-5 text-[#647DAA] sm:text-sm">
                        Jadwal, KRS, nilai, dan informasi akademik lainnya.
                    </p>
                    <div class="mt-3 flex items-center gap-2 rounded-xl bg-blue-50/80 p-3">
                        <span class="flex size-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="4" y="5" width="16" height="15" rx="2" stroke-width="1.8"/>
                                <path stroke-linecap="round" stroke-width="1.8" d="M8 3v4m8-4v4M4 10h16m-11 4h2m3 0h2"/>
                            </svg>
                        </span>
                        <div class="flex-1 space-y-1.5">
                            <div class="h-1.5 w-4/5 rounded-full bg-blue-200"></div>
                            <div class="h-1.5 w-1/2 rounded-full bg-blue-100"></div>
                        </div>
                    </div>
                </article>

                {{-- Portal Mahasiswa --}}
                <article class="rounded-[24px] border border-white bg-white/95 p-4 shadow-[0_18px_40px_rgba(37,99,235,0.12)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 sm:p-5 lg:absolute lg:right-[2%] lg:top-[7%] lg:w-[45%] lg:rotate-[4deg]">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex size-12 items-center justify-center rounded-2xl bg-blue-500 text-white sm:size-14">
                            <svg class="size-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m8-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>
                            </svg>
                        </div>
                        <span class="flex size-9 items-center justify-center rounded-full bg-yellow-50 text-[#EFA900]">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/>
                            </svg>
                        </span>
                    </div>
                    <h3 class="mt-3 text-base font-bold text-[#0F1B3D] sm:text-lg">Portal Mahasiswa</h3>
                    <p class="mt-1 text-xs leading-5 text-[#647DAA] sm:text-sm">
                        Layanan dan informasi untuk mahasiswa UNM.
                    </p>
                    <div class="mt-4 flex gap-2">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-blue-50 text-blue-500">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="3" stroke-width="1.8"/>
                                <path stroke-linecap="round" stroke-width="1.8" d="M6 19v-2a6 6 0 0 1 12 0v2"/>
                            </svg>
                        </span>
                        <span class="flex size-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-500">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="5" y="4" width="14" height="16" rx="2" stroke-width="1.8"/>
                                <path stroke-linecap="round" stroke-width="1.8" d="M8 9h8m-8 4h8m-8 4h4"/>
                            </svg>
                        </span>
                        <span class="flex size-10 items-center justify-center rounded-xl bg-violet-50 text-violet-500">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5h16v12H9l-5 3V5Z"/>
                            </svg>
                        </span>
                    </div>
                </article>

                {{-- Logo tengah --}}
                <div class="col-span-2 flex justify-center py-1 lg:absolute lg:left-1/2 lg:top-1/2 lg:z-20 lg:-translate-x-1/2 lg:-translate-y-1/2 lg:py-0">
                    <div class="flex size-24 items-center justify-center rounded-[28px] border-[6px] border-white bg-white shadow-[0_15px_40px_rgba(37,99,235,0.18)] sm:size-28">
                        <img
                            src="{{ asset('storage/layanan-logo/logo-unm.png') }}"
                            alt="Logo Universitas Negeri Makassar"
                            class="size-[78%] object-contain"
                        >
                    </div>
                </div>

                {{-- Perpustakaan Digital --}}
                <article class="rounded-[24px] border border-white bg-white/95 p-4 shadow-[0_18px_40px_rgba(37,99,235,0.12)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 sm:p-5 lg:absolute lg:bottom-[-17%] lg:left-[1%] lg:w-[44%] lg:rotate-[-3deg]">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex size-12 items-center justify-center rounded-2xl bg-indigo-500 text-white sm:size-14">
                            <svg class="size-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 7v14m0-14C9 4 6 4 3 5v14c3-1 6-1 9 2m0-14c3-3 6-3 9-2v14c-3-1-6-1-9 2"/>
                            </svg>
                        </div>
                        <span class="flex size-9 items-center justify-center rounded-full bg-yellow-50 text-[#EFA900]">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/>
                            </svg>
                        </span>
                    </div>
                    <h3 class="mt-3 text-base font-bold text-[#0F1B3D] sm:text-lg">Perpustakaan Digital</h3>
                    <p class="mt-1 text-xs leading-5 text-[#647DAA] sm:text-sm">
                        Akses buku, jurnal, dan koleksi digital UNM.
                    </p>
                    <div class="mt-3 flex items-center gap-2 rounded-xl bg-blue-50/80 p-3">
                        <span class="flex size-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5h16v14H4zM8 9h8m-8 4h8"/>
                            </svg>
                        </span>
                        <div class="flex-1 space-y-1.5">
                            <div class="h-1.5 w-3/4 rounded-full bg-blue-200"></div>
                            <div class="h-1.5 w-1/2 rounded-full bg-blue-100"></div>
                        </div>
                        <span class="text-blue-500">›</span>
                    </div>
                </article>

                {{-- Fakultas & Prodi --}}
                <article class="rounded-[24px] border border-white bg-white/95 p-4 shadow-[0_18px_40px_rgba(37,99,235,0.12)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 sm:p-5 lg:absolute lg:bottom-[-17%] lg:right-[2%] lg:w-[44%] lg:rotate-[4deg]">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex size-12 items-center justify-center rounded-2xl bg-blue-500 text-white sm:size-14">
                            <svg class="size-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6M3 9h18"/>
                            </svg>
                        </div>
                        <span class="flex size-9 items-center justify-center rounded-full bg-yellow-50 text-[#EFA900]">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/>
                            </svg>
                        </span>
                    </div>
                    <h3 class="mt-3 text-base font-bold text-[#0F1B3D] sm:text-lg">Fakultas &amp; Prodi</h3>
                    <p class="mt-1 text-xs leading-5 text-[#647DAA] sm:text-sm">
                        Temukan fakultas, program studi dan informasi lengkapnya.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="rounded-lg bg-blue-100 px-3 py-2 text-xs font-bold text-blue-600">FT</span>
                        <span class="rounded-lg bg-amber-100 px-3 py-2 text-xs font-bold text-amber-600">FE</span>
                        <span class="rounded-lg bg-emerald-100 px-3 py-2 text-xs font-bold text-emerald-600">FISIP</span>
                        <span class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-500">•••</span>
                    </div>
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
                        <img src="{{ Storage::url($item->logo ?: 'layanan-logo/logo-unm.png') }}" alt="{{ $item->nama_layanan }}" class="size-full object-contain p-2.5">
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
