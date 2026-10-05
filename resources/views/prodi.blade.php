<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="relative z-30 py-12 sm:py-16">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-[#0F1B3D] shadow-sm">
                <span class="size-2 rounded-full bg-[#FFC400]"></span>
                Direktori UNM
            </div>
            <h1 class="mt-5 text-4xl font-semibold tracking-[-0.035em] text-[#0F1B3D] sm:text-5xl">{{ $title }}</h1>
            <p class="mt-4 max-w-2xl text-base leading-7 text-[#64748B]">Temukan portal program studi Universitas Negeri Makassar dengan mudah.</p>
            <div class="mt-7">
                <livewire:global-search
                    :form-action="url()->current()"
                    :preserved-query="request()->except(['search'])"
                    :initial-query="request('search')"
                    variant="hero"
                />
            </div>
        </div>
    </section>

    <livewire:public-directory :kategori-id="$kategori->id" kind="prodi" :search="request('search')" />
</x-layout>
