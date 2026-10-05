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
                        <div><dt class="font-medium text-[#64748B]">Pemilik</dt><dd class="mt-1 font-semibold text-[#0F1B3D]">{{ $layanan->creator?->username ?? '-' }}</dd></div>
                        <div><dt class="font-medium text-[#64748B]">Tanggal dibuat</dt><dd class="mt-1 font-semibold text-[#0F1B3D]">{{ $layanan->created_at->translatedFormat('d F Y') }}</dd></div>
                        <div><dt class="font-medium text-[#64748B]">Jumlah kunjungan</dt><dd class="mt-1 font-semibold text-[#0F1B3D]">{{ number_format($layanan->clicks) }}</dd></div>
                    </dl>
                </div>
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
