<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <livewire:public-directory :kategori-id="$kategori->id" kind="prodi" />
</x-layout>
