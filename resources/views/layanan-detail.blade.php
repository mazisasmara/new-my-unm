<x-service-layout :title="$title">
    <div class="mx-auto grid max-w-6xl gap-7 px-5 py-10 lg:grid-cols-[300px_minmax(0,1fr)] lg:items-center lg:py-16">
        <aside class="rounded-[28px] border border-white/20 bg-slate-950/60 p-6 text-white shadow-2xl backdrop-blur-md">
            <div class="flex items-start justify-between gap-4">
                <div class="flex size-20 shrink-0 items-center justify-center overflow-hidden rounded-full bg-white/90 p-2">
                    <img src="{{ Storage::url($layanan->logo ?: 'layanan-logo/gambar.png') }}" alt="Logo {{ $layanan->nama_layanan }}" class="size-full object-contain">
                </div>
                <div class="pt-3 text-center"><p class="text-2xl leading-none">{{ $layanan->created_at->format('d') }}</p><p class="mt-1 text-sm">{{ $layanan->created_at->translatedFormat('M') }}</p></div>
            </div>

            <div class="mt-10 text-center">
                <h1 class="text-2xl font-medium uppercase leading-tight">{{ $layanan->nama_layanan }}</h1>
                <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-200">{{ $layanan->deskripsi }}</p>
            </div>

            <a href="{{ $backUrl }}" class="mt-8 block w-full rounded-full bg-white px-4 py-2.5 text-center text-sm font-semibold text-slate-800 transition hover:bg-yellow-300">Kembali</a>

            @if ($layanan->clicks > 0)
                <p class="mt-5 flex items-center justify-center gap-2 text-xs font-semibold text-white"><span class="text-lg text-red-400">•</span> paling sering dikunjungi</p>
            @endif
        </aside>

        <section class="min-h-[460px] rounded-xl bg-white p-7 shadow-2xl sm:p-10">
            <div class="mx-auto flex max-w-md flex-col items-center text-center">
                <div class="flex h-36 w-full items-center justify-center sm:h-40">
                    <img src="{{ Storage::url($layanan->logo ?: 'layanan-logo/gambar.png') }}" alt="Logo {{ $layanan->nama_layanan }}" class="h-full max-w-full object-contain">
                </div>
                <h2 class="mt-4 text-2xl font-bold text-slate-900">{{ $layanan->nama_layanan }}</h2>
                <h3 class="mt-7 text-2xl font-semibold text-slate-950">Detail</h3>
                <span class="mt-2 h-1 w-16 rounded-full bg-orange-500"></span>
            </div>

            <dl class="mx-auto mt-8 grid max-w-xl gap-5 text-sm sm:grid-cols-2">
                <div class="sm:col-span-2"><dt class="font-semibold text-slate-900">Nama layanan</dt><dd class="mt-1 text-slate-600">{{ $layanan->nama_layanan }}</dd></div>
                <div><dt class="font-semibold text-slate-900">Pemilik</dt><dd class="mt-1 text-slate-600">{{ $layanan->creator?->username ?? '-' }}</dd></div>
                <div><dt class="font-semibold text-slate-900">Dibuat</dt><dd class="mt-1 text-slate-600">{{ $layanan->created_at->translatedFormat('d F Y') }}</dd></div>
                <div class="sm:col-span-2"><dt class="font-semibold text-slate-900">Deskripsi</dt><dd class="mt-1 whitespace-pre-line leading-6 text-slate-600">{{ $layanan->deskripsi ?: '-' }}</dd></div>
                <div><dt class="font-semibold text-slate-900">Jumlah pengunjung</dt><dd class="mt-1 text-slate-600">{{ number_format($layanan->clicks) }}</dd></div>
            </dl>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('layanan.visit', $layanan) }}" target="_blank" rel="noopener noreferrer" class="rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600">Lihat web nya</a>
            </div>
        </section>
    </div>
</x-service-layout>
