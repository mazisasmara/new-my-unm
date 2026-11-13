<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-10 sm:py-14 lg:py-16">
        <a href="{{ $backUrl }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#64748B] transition hover:text-[#0F1B3D]">
            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 18-6-6 6-6"/></svg>
            Kembali ke direktori
        </a>

        <div class="mt-7 grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-start">
            <section class="rounded-[24px] border border-[#E2E8F0] bg-white p-6 shadow-[0_12px_40px_rgba(15,23,42,0.05)] sm:p-9">
                <div class="flex flex-col gap-6 sm:flex-row sm:items-start">
                    <div class="flex size-24 shrink-0 items-center justify-center overflow-hidden rounded-[22px] bg-slate-50 ring-1 ring-slate-100">
                        <img src="{{ Storage::url($layanan->logo ?: 'layanan-logo/logo-unm.png') }}" alt="Logo {{ $layanan->nama_layanan }}" class="size-full object-contain p-3">
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#64748B]">{{ $layanan->group?->nama_group ?? 'Universitas Negeri Makassar' }}</p>
                        <h1 class="mt-2 text-3xl font-semibold leading-tight tracking-[-0.03em] text-[#0F1B3D] sm:text-4xl">{{ $layanan->nama_layanan }}</h1>
                        @if ($layanan->deskripsi)
                            <p class="mt-4 max-w-2xl whitespace-pre-line text-base leading-7 text-[#64748B]">{{ $layanan->deskripsi }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-9 border-t border-slate-100 pt-7">
                    <h2 class="text-xl font-semibold text-[#0F1B3D]">Detail layanan</h2>
                    <dl class="mt-5 grid gap-5 text-sm sm:grid-cols-2">
                        {{--
                        <div><dt class="font-medium text-[#64748B]">Pemilik</dt><dd class="mt-1 font-semibold text-[#0F1B3D]">{{ $layanan->creator?->username ?? '-' }}</dd></div>
                        --}}
                        <div><dt class="font-medium text-[#64748B]">Tanggal dibuat</dt><dd class="mt-1 font-semibold text-[#0F1B3D]">{{ $layanan->created_at->translatedFormat('d F Y') }}</dd></div>
                        <div><dt class="font-medium text-[#64748B]">Jumlah kunjungan</dt><dd class="mt-1 font-semibold text-[#0F1B3D]">{{ number_format($layanan->clicks) }}</dd></div>
                    </dl>
                </div>

                @if ($layanan->informasi_dokumen || $layanan->link_dokumen || $layanan->link_panduan)
                <div class="mt-8 border-t border-slate-100 pt-7">
                    <h3 class="text-lg font-semibold text-[#0F1B3D]">
                        Informasi & Dokumen
                    </h3>

                    @if ($layanan->informasi_dokumen)
                        <div class="mt-4 rounded-xl border border-slate-200 p-5">
                            <p class="text-sm font-semibold text-[#0F1B3D]">
                                Informasi Dokumen
                            </p>

                            <p class="mt-2 whitespace-pre-line text-sm leading-7 text-[#64748B]">{{ $layanan->informasi_dokumen }}</p>
                        </div>
                    @endif

                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        @if ($layanan->link_dokumen)
                            <a
                                href="{{ $layanan->link_dokumen }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group flex items-center gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50"
                            >
                                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3.75h6l5 5v11.5a.75.75 0 0 1-.75.75h-10.5a.75.75 0 0 1-.75-.75v-15.75A.75.75 0 0 1 7 3.75Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 3.75v5h5M9 13h6m-6 3h6"/>
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

                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 shrink-0 text-slate-400 transition group-hover:translate-x-1 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M7 7h10v10"/>
                                </svg>
                            </a>
                        @endif

                        @if ($layanan->link_panduan)
                            <a
                                href="{{ $layanan->link_panduan }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group flex items-center gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50"
                            >
                                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.5c-1.5-1.1-3.5-1.75-6-1.75H4.75A.75.75 0 0 0 4 5.5v13c0 .414.336.75.75.75H6c2.5 0 4.5.65 6 1.75m0-14.5c1.5-1.1 3.5-1.75 6-1.75h1.25a.75.75 0 0 1 .75.75v13a.75.75 0 0 1-.75.75H18c-2.5 0-4.5.65-6 1.75m0-14.5v14.5"/>
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

                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 shrink-0 text-slate-400 transition group-hover:translate-x-1 group-hover:text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M7 7h10v10"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            </section>

            <aside class="rounded-[24px] bg-[#0F1B3D] p-6 text-white shadow-[0_18px_50px_rgba(15,27,61,0.16)]">
                <div class="flex size-11 items-center justify-center rounded-2xl bg-[#FFC400] text-[#0F1B3D]">
                    <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 10.5 21 3m0 0h-6m6 0v6M10 5H6a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-4"/></svg>
                </div>
                <h2 class="mt-6 text-xl font-semibold">Buka layanan</h2>
                <p class="mt-2 text-sm leading-6 text-slate-300">Anda akan diarahkan ke situs resmi layanan pada tab baru.</p>
                <a href="{{ route('layanan.visit', $layanan) }}" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-[#FFC400] px-5 py-3.5 text-sm font-semibold text-[#0F1B3D] transition hover:bg-yellow-300">
                    Buka Layanan
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            </aside>
        </div>
    </div>
</x-layout>
