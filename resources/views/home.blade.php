<x-layout>
    <x-slot:title>UNM Digital Hub</x-slot:title>
    <div
    x-data="{
        modalOpen: false,
        selectedService: null,

        openService(service) {
            this.selectedService = service;
            this.modalOpen = true;
        },

        closeModal() {
            this.modalOpen = false;
        }
    }"
    @keydown.escape.window="closeModal()"
    x-effect="document.body.classList.toggle('overflow-hidden', modalOpen)"
    >

    
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
            <button
                type="button"
                @click="openService(@js([
                    'nama' => $item->nama_layanan,
                    'group' => $item->group?->nama_group ?? 'Universitas Negeri Makassar',
                    'logo' => Storage::url($item->logo ?: 'layanan-logo/logo-unm.png'),
                    'deskripsi' => $item->deskripsi,
                    'clicks' => number_format($item->clicks),
                    'informasi' => $item->informasi_dokumen,
                    'dokumen' => $item->link_dokumen,
                    'panduan' => $item->link_panduan,
                    'visitUrl' => route('layanan.visit', $item),
                ]))"
                class="group flex min-h-72 w-full flex-col rounded-[22px] border border-[#E2E8F0] bg-white p-6 text-left shadow-[0_8px_30px_rgba(15,23,42,0.04)] transition duration-300 hover:-translate-y-1.5 hover:border-[#FFC400] hover:shadow-[0_18px_45px_rgba(15,27,61,0.1)]"
            >
                <div class="flex size-14 items-center justify-center overflow-hidden rounded-2xl bg-slate-50 ring-1 ring-slate-100">
                    <img
                        src="{{ Storage::url($item->logo ?: 'layanan-logo/logo-unm.png') }}"
                        alt="Logo {{ $item->nama_layanan }}"
                        class="size-full object-contain p-2.5"
                    >
                </div>

                <div class="mt-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#64748B]">
                        {{ $item->group?->nama_group ?? 'UNM' }}
                    </p>

                    <h3 class="mt-2 text-xl font-semibold leading-snug text-[#0F1B3D]">
                        {{ $item->nama_layanan }}
                    </h3>

                    @if ($item->deskripsi)
                        <p class="mt-3 text-sm leading-6 text-[#64748B]">
                            {{ Str::limit($item->deskripsi, 110) }}
                        </p>
                    @endif
                </div>

                <span class="mt-auto inline-flex items-center gap-2 pt-7 text-sm font-semibold text-[#0F1B3D]">
                    Buka Layanan
                    <svg class="size-4 transition-transform group-hover:translate-x-1"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </span>
            </button>
        @empty
            {{-- Pertahankan bagian empty state milikmu --}}
        @endforelse

        </div>
    </section>

{{-- MODAL DETAIL LAYANAN --}}
<template x-teleport="body">
    <div
        x-show="modalOpen"
        x-transition.opacity.duration.200ms
    style="display: none;"
    class="fixed inset-x-0 top-[80px] bottom-0 z-[9999] flex flex-col items-center justify-start overflow-y-auto bg-[#0F1B3D]/65 p-3 backdrop-blur-sm sm:p-6"
    @click.self="closeModal()"
    aria-modal="true"
    role="dialog"
    aria-label="Detail layanan"
>
    <div
        x-show="modalOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4 scale-[0.98]"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        class="relative my-auto w-full max-w-5xl max-h-[calc(100dvh-104px)] sm:max-h-[calc(100dvh-128px)] shrink-0 overflow-y-auto overscroll-contain rounded-[24px] bg-white shadow-2xl"
        @click.stop
    >
        {{-- Tombol tutup --}}
        <button
            type="button"
            @click="closeModal()"
            aria-label="Tutup modal"
            class="absolute right-4 top-4 z-20 flex size-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:bg-slate-100 hover:text-[#0F1B3D]"
        >
            <svg class="size-5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="grid lg:grid-cols-[minmax(0,1fr)_260px]">

            {{-- INFORMASI LAYANAN --}}
            <section class="min-w-0 p-5 pt-16 sm:p-8 sm:pt-16 lg:p-8">

                {{-- Header --}}
                <div class="flex flex-col gap-5 sm:flex-row sm:items-start">
                    <div class="flex size-16 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-slate-50 ring-1 ring-slate-100 sm:size-20">
                        <img
                            :src="selectedService?.logo"
                            :alt="'Logo ' + (selectedService?.nama ?? '')"
                            class="h-full w-full object-contain p-3"
                        >
                    </div>

                    <div class="min-w-0">
                        <p
                            class="text-xs font-semibold uppercase tracking-[0.16em] text-[#64748B]"
                            x-text="selectedService?.group"
                        ></p>

                        <h2
                            class="mt-2 text-2xl font-semibold leading-tight tracking-tight text-[#0F1B3D] sm:text-3xl"
                            x-text="selectedService?.nama"
                        ></h2>

                        <p
                            x-show="selectedService?.deskripsi"
                            class="mt-3 whitespace-pre-line text-sm leading-7 text-[#64748B]"
                            x-text="selectedService?.deskripsi"
                        ></p>
                    </div>
                </div>

                {{-- Detail --}}
                <div class="mt-8 border-t border-slate-100 pt-6">
                    <h3 class="text-lg font-semibold text-[#0F1B3D]">
                        Detail layanan
                    </h3>

                    <dl class="mt-4 grid gap-4 text-sm sm:grid-cols-2">
                        <div>
                            <dt class="text-[#64748B]">
                                Jumlah kunjungan
                            </dt>
                            <dd
                                class="mt-1 font-semibold text-[#0F1B3D]"
                                x-text="selectedService?.clicks"
                            ></dd>
                        </div>
                    </dl>
                </div>

                {{-- Informasi dan dokumen --}}
                <template x-if="
                    selectedService?.informasi ||
                    selectedService?.dokumen ||
                    selectedService?.panduan
                ">
                    <div class="mt-7 border-t border-slate-100 pt-6">
                        <h3 class="text-lg font-semibold text-[#0F1B3D]">
                            Informasi & Dokumen
                        </h3>

                        {{-- Informasi dokumen --}}
                        <template x-if="selectedService?.informasi">
                            <div class="mt-4 rounded-xl border border-slate-200 p-4 sm:p-5">
                                <p class="text-sm font-semibold text-[#0F1B3D]">
                                    Informasi Dokumen
                                </p>

                                <p
                                    class="mt-2 whitespace-pre-line text-sm leading-7 text-[#64748B]"
                                    x-text="selectedService?.informasi"
                                ></p>
                            </div>
                        </template>

                        {{-- Link dokumen dan panduan --}}
                        <div class="mt-4 grid gap-3 sm:grid-cols-2">

                            <template x-if="selectedService?.dokumen">
                                <a
                                    :href="selectedService.dokumen"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="group flex min-w-0 items-center gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50"
                                >
                                    <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                        <svg class="size-5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.8"
                                                d="M7 3.75h6l5 5v11.5a.75.75 0 0 1-.75.75h-10.5a.75.75 0 0 1-.75-.75v-15.75A.75.75 0 0 1 7 3.75Z"/>
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.8"
                                                d="M13 3.75v5h5M9 13h6m-6 3h6"/>
                                        </svg>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <p class="font-semibold text-[#0F1B3D]">
                                            Dokumen
                                        </p>
                                        <p class="mt-1 text-xs text-[#64748B]">
                                            Lihat dokumen
                                        </p>
                                    </div>

                                    <span class="text-slate-400">↗</span>
                                </a>
                            </template>

                            <template x-if="selectedService?.panduan">
                                <a
                                    :href="selectedService.panduan"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="group flex min-w-0 items-center gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50"
                                >
                                    <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                        <svg class="size-5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.8"
                                                d="M12 6.5c-1.5-1.1-3.5-1.75-6-1.75H4.75A.75.75 0 0 0 4 5.5v13c0 .414.336.75.75.75H6c2.5 0 4.5.65 6 1.75m0-14.5c1.5-1.1 3.5-1.75 6-1.75h1.25a.75.75 0 0 1 .75.75v13a.75.75 0 0 1-.75.75H18c-2.5 0-4.5.65-6 1.75m0-14.5v14.5"/>
                                        </svg>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <p class="font-semibold text-[#0F1B3D]">
                                            Panduan
                                        </p>
                                        <p class="mt-1 text-xs text-[#64748B]">
                                            Lihat petunjuk penggunaan layanan
                                        </p>
                                    </div>

                                    <span class="text-slate-400">↗</span>
                                </a>
                            </template>

                        </div>
                    </div>
                </template>
            </section>

            {{-- PANEL BUKA LAYANAN --}}
            <aside class="flex flex-col justify-between bg-[#0F1B3D] p-6 text-white sm:p-8 lg:p-6">

                <div>
                     <div class="flex size-11 items-center justify-center rounded-2xl bg-[#FFC400] text-[#0F1B3D]">
                        <svg class="size-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M13.5 10.5 21 3m0 0h-6m6 0v6M10 5H6a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-4"/>
                        </svg>
                    </div>

                    <h3 class="mt-6 text-xl font-semibold">
                        Buka layanan
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-300">
                        Anda akan diarahkan ke situs resmi layanan pada tab baru.
                    </p>
                </div>

                <a
                    :href="selectedService?.visitUrl"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="mt-7 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-[#FFC400] px-5 py-3.5 text-sm font-semibold text-[#0F1B3D] transition hover:bg-yellow-300"
                >
                    Buka Layanan

                    <svg class="size-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </a>

            </aside>
        </div>
    </div>
</div>
</template>
</x-layout>
