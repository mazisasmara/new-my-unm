<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="relative z-40 flex justify-center pt-8 pb-12">
        <div class="w-full max-w-lg"><x-search :owner="$filteredUser"></x-search></div>
    </div>

    <livewire:public-directory :kategori-id="$kategori->id" kind="layanan" :search="request('search')" :owner="$filteredUser?->username" />
</x-layout>
