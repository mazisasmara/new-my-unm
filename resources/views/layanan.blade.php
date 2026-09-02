<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="relative z-10 flex justify-center pt-8 pb-12">
        <div class="w-full max-w-lg"><x-search :owner="$filteredUser"></x-search></div>
    </div>

    <div class="relative z-10 px-6 pb-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($kategori->groups as $group)
                @foreach ($group->layanans as $item)
                    <a href="{{ route('layanan.show', $item) }}" class="group relative flex min-h-[370px] overflow-hidden rounded-[42px] border border-white/10 bg-black/35 shadow-xl backdrop-blur-[2px] transition-all duration-300 hover:-translate-y-2 hover:bg-black/45 hover:shadow-2xl">
                        <div class="relative flex w-full min-h-[370px] flex-col p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex h-[100px] w-[100px] shrink-0 items-center justify-center overflow-hidden rounded-full bg-gray-200">
                                    <img src="{{ Storage::url($item->logo ?: 'layanan-logo/logo-unm.png') }}" alt="Logo {{ $item->nama_layanan }}" class="size-full object-contain p-2">
                                </div>
                                <div class="pt-7 text-center text-white"><div class="text-2xl font-normal leading-none">{{ $item->created_at->format('d') }}</div><div class="mt-1 text-xl leading-none">{{ $item->created_at->translatedFormat('M') }}</div></div>
                            </div>

                            <div class="mt-12 text-center">
                                <h3 class="line-clamp-1 text-3xl font-normal uppercase tracking-tight text-white">{{ $item->nama_layanan }}</h3>
                                <p class="mt-2 line-clamp-2 px-2 text-sm uppercase leading-tight text-white">{{ $item->creator?->username }}</p>
                                <p class="mt-1 line-clamp-2 px-4 text-sm leading-tight text-white">{{ $item->deskripsi }}</p>
                            </div>

                            <div class="mt-auto pt-5">
                                <div class="flex justify-center"><span class="inline-flex h-10 w-28 items-center justify-center rounded-full bg-gray-200 text-sm font-medium text-gray-800 transition group-hover:bg-white">Lihat</span></div>
                                @if ($item->clicks > 0)
                                    <div class="mt-5 flex items-center justify-center gap-2 text-center"><span class="text-lg text-red-500">•</span><span class="text-xs font-semibold text-white">paling sering dikunjungi</span></div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>
</x-layout>
