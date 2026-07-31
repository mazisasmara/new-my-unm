<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 px-3">
    @foreach ($kategori->groups as $group)
    @foreach ($group->layanans as $item)

        <div class="layanan bg-blue-300 text-black px-3 py-3 w-auto text-center">
            <img src="{{ asset($item->logo ?? 'logo/gambar.png') }}" alt="logo" class="w-30 rounded-xl mx-auto">

            <h1 class="py-3">{{ $item->nama_layanan }}</h1>

            <p>{{ $item->deskripsi }}</p>

            <a href="{{ $item->link }}" class="bg-emerald-300">
                Kunjungi<br>
                {{ $item->link }}
            </a>
        </div>

    @endforeach
@endforeach
  </div>
</x-layout>