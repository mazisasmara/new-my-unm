<div class="mb-7 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
    <form method="GET" action="{{ url()->current() }}">
        @foreach(request()->except(['search']) as $key => $value)
            @if(is_scalar($value))
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <label for="search" class="mb-2 block text-sm font-semibold text-slate-700">
            Cari arsip atau layanan
        </label>
        <div class="flex flex-col gap-2 sm:flex-row">
            <div class="relative min-w-0 flex-1">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 size-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/></svg>
                <input type="search" id="search" name="search" value="{{ request('search') }}" placeholder="Masukkan nama layanan atau kata kunci..." class="w-full rounded-xl border border-slate-300 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
            </div>
            <button type="submit" class="rounded-xl bg-blue-700 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">Cari</button>
            @if(request()->filled('search'))
                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="rounded-xl border border-slate-300 px-4 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">Reset</a>
            @endif
        </div>

        @if($owner)
            <div class="mt-4 flex flex-wrap items-center gap-2 border-t border-slate-100 pt-4 text-sm">
                <span class="text-slate-500">Menampilkan layanan milik:</span>
                <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1.5 font-semibold text-blue-700">{{ $owner->username }}</span>
                <a href="{{ request()->fullUrlWithQuery(['user' => null]) }}" class="font-semibold text-red-600 hover:underline">Hapus filter pemilik</a>
            </div>
        @endif
    </form>
</div>
