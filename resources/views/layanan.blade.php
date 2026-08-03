<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-search></x-search>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 px-3">
        @foreach ($kategori->groups as $group)
            @foreach ($group->layanans as $item)
                <div
                    class="flex flex-col md:flex-row max-w-xl overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200"
                >
                    <img
                        class="object-cover w-full h-64 md:h-auto md:w-48"
                        src="{{ Storage::url($item->logo) }}"
                        alt="logo"
                    />

                    <div class="flex flex-col justify-between p-6">
                        <div>
                            <a
                                href="{{ request()->fullUrlWithQuery(['user' => $item->creator->id]) }}"
                                class="font-semibold text-blue-600 hover:underline"
                                onclick="event.stopPropagation();"
                            >
                                {{ $item->creator->username }}
                            </a>
                            <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                            >
                                {{ $item->nama_layanan }}
                            </h5>

                            <p class="mb-9 text-gray-600">{{ $item->deskripsi }}</p>
                            <p class="mb-6 text-gray-900">Dibuat {{ $item->created_at->diffForHumans() }}</p>
                            <p class="mb-6 text-gray-400">Total pengunjung: {{ $item->clicks }}</p>
                        </div>

                        <div>
                            <a
                                href="{{ route('layanan.visit', $item) }}"
                                target="_blank"
                                type="button"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 hover:text-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-200"
                            >
                                Kunjungi {{ $item->link }}

                                <svg
                                    class="w-4 h-4 ml-1.5"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 12H5m14 0-4 4m4-4-4-4"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            @endforeach
        @endforeach
    </div>
</x-layout>
