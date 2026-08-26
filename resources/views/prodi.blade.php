<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <x-search></x-search>

 <div class="section">
  <img src="{{ Storage::url($item->logo ?: 'layanan-logo/gambar.png') }}" alt="Logo">
  <br>
  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Libero hic amet perferendis voluptate?</p>
  
 </div>
 
</x-layout>