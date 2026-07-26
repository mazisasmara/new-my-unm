<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 px-3">
    @foreach ($layanan as $item)
    <div class="layanan bg-blue-300 text-black px-3 py-3 w-auto text-center">
      <img src="{{ asset($item['logoPath']) }}" class="w-30 rounded-xl mx-auto"></img>
      <h1 class="py-5">{{ $item['namaLayanan'] }}</h1>
      <p>{{ $item['deskripsi'] }}</p>
      <button href="{{ $item['link'] }}" class="bg-emerald-300"><a>Kunjungi <br> {{ $item['link'] }}</br></a></a>
    </div>
    @endforeach
  </div>
</x-layout>