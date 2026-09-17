<div
    class="mb-7 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5"
    x-data="{ open: false, active: -1 }"
    @click.outside="open = false; active = -1"
    @keydown.escape.window="open = false; active = -1"
>
    <form method="GET" action="{{ $formAction }}">
        @foreach($preservedQuery as $key => $value)
            @if(is_scalar($value))
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <div class="flex flex-col gap-2 sm:flex-row">
            <div class="relative min-w-0 flex-1">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 size-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/></svg>
                <input
                    type="search"
                    id="search"
                    name="search"
                    wire:model.live.debounce.300ms="query"
                    @focus="open = true"
                    @input="open = true; active = -1"
                    @keydown.arrow-down.prevent="if ({{ count($this->suggestions) }}) { open = true; active = Math.min(active + 1, {{ max(count($this->suggestions) - 1, 0) }}) }"
                    @keydown.arrow-up.prevent="active = Math.max(active - 1, 0)"
                    @keydown.enter="if (open && active >= 0) { $event.preventDefault(); window.location.href = $refs['suggestion' + active].href }"
                    placeholder="Masukkan nama layanan atau kata kunci..."
                    autocomplete="off"
                    role="combobox"
                    :aria-expanded="open && {{ trim($query) !== '' ? 'true' : 'false' }}"
                    aria-controls="global-search-suggestions"
                    class="w-full rounded-xl border border-slate-300 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
                >

                @if(trim($query) !== '')
                    <div
                        id="global-search-suggestions"
                        x-show="open"
                        x-transition.opacity.duration.150ms
                        class="absolute inset-x-0 top-full z-[70] mt-2 max-h-[min(28rem,70vh)] overflow-y-auto rounded-xl border border-slate-200 bg-white py-2 shadow-2xl"
                        role="listbox"
                    >
                        @forelse($this->suggestions as $index => $suggestion)
                            <a
                                href="{{ $suggestion['url'] }}"
                                x-ref="suggestion{{ $index }}"
                                @mouseenter="active = {{ $index }}"
                                :class="active === {{ $index }} ? 'bg-blue-50' : 'hover:bg-slate-50'"
                                class="block px-4 py-3 transition"
                                role="option"
                                :aria-selected="active === {{ $index }}"
                            >
                                <span class="block truncate text-sm font-semibold text-slate-900">{{ $suggestion['title'] }}</span>
                                <span class="mt-0.5 block text-xs font-medium text-slate-500">{{ $suggestion['type'] }}</span>
                            </a>
                        @empty
                            <p class="px-4 py-4 text-sm text-slate-500">Tidak ada hasil yang cocok.</p>
                        @endforelse

                        
                    </div>
                @endif
            </div>
            <button type="submit" class="app-button-primary px-6 py-3 text-sm">Cari</button>
            @if($query !== '')
                <a href="{{ $formAction }}{{ $preservedQuery ? '?'.http_build_query($preservedQuery) : '' }}" class="rounded-xl border border-slate-300 px-4 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">Reset</a>
            @endif
        </div>

        @if($ownerUsername)
            <div class="mt-4 flex flex-wrap items-center gap-2 border-t border-slate-100 pt-4 text-sm">
                <span class="text-slate-500">Menampilkan layanan milik:</span>
                <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1.5 font-semibold text-blue-700">{{ $ownerUsername }}</span>
                <a href="{{ $formAction }}?{{ http_build_query(array_diff_key($preservedQuery, ['user' => true])) }}" class="font-semibold text-red-600 hover:underline">Hapus filter pemilik</a>
            </div>
        @endif
    </form>
</div>
