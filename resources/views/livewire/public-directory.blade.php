<div
    wire:poll.visible.10s
    class="pb-16"
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
    @if ($kind === 'layanan')
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($kategori->groups as $directoryGroup)
                @foreach ($directoryGroup->layanans as $item)
                    <button
                        type="button"
                        @click="openService(@js([
                            'nama' => $item->nama_layanan,
                            'group' => $directoryGroup->nama_group,
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
                                <p class="mt-3 text-sm leading-6 text-[#64748B]">{{ Str::limit($item->deskripsi, 110) }}</p>
                            @endif
                        </div>
                        <span class="mt-auto inline-flex items-center gap-2 pt-7 text-sm font-semibold text-[#0F1B3D]">Buka Layanan <svg class="size-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/></svg></span>
                    </button>
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

</div>
