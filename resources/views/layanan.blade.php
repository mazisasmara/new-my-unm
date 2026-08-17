<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-search></x-search>

    {{-- Daftar Layanan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-3">

        @foreach ($kategori->groups as $group)
            @foreach ($group->layanans as $item)

                <div
                    class="group cursor-pointer overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200"
                    onclick="openLayananModal({{ $item->id }})"
                >
                    <div class="flex flex-col">

                        {{-- Logo --}}
                        <div class="w-full h-48 bg-gray-50 flex items-center justify-center overflow-hidden">
                            <img
                                class="w-full h-full object-contain p-4"
                                src="{{ Storage::url($item->logo ?: 'layanan-logo/gambar.png') }}"
                                alt="Logo {{ $item->nama_layanan }}"
                            />
                        </div>

                        {{-- Isi Card --}}
                        <div class="p-5">

                            {{-- Pemilik --}}
                            <a
                                href="{{ request()->fullUrlWithQuery(['user' => $item->creator->id]) }}"
                                class="inline-block mb-2 text-sm text-blue-600 hover:underline"
                                onclick="event.stopPropagation();"
                            >
                                {{ $item->creator->username }}
                            </a>

                            {{-- Nama --}}
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                                {{ $item->nama_layanan }}
                            </h5>

                            {{-- Preview Deskripsi --}}
                            <p class="mb-4 text-sm text-gray-600 line-clamp-2">
                                {{ $item->deskripsi }}
                            </p>

                            {{-- Informasi --}}
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>
                                    Dibuat {{ $item->created_at->diffForHumans() }}
                                </span>

                                <span>
                                    {{ $item->clicks }} pengunjung
                                </span>
                            </div>

                            {{-- Petunjuk --}}
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm font-medium text-blue-600">
                                    Lihat detail →
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

            @endforeach
        @endforeach

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL DETAIL LAYANAN --}}
    {{-- ========================================================= --}}

    <div
        id="layananModal"
        class="fixed inset-0 z-50 hidden items-center justify-center p-4"
        aria-hidden="true"
    >

        {{-- Overlay --}}
        <div
            class="absolute inset-0 bg-black/50 backdrop-blur-sm"
            onclick="closeLayananModal()"
        ></div>


        {{-- Modal --}}
        <div
            class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-2xl"
            onclick="event.stopPropagation();"
        >

            {{-- Header --}}
            <div class="flex items-center justify-between p-5 border-b">

                <div>
                    <p
                        id="modalCreator"
                        class="text-sm text-blue-600 font-medium"
                    ></p>

                    <h2
                        id="modalTitle"
                        class="mt-1 text-xl font-bold text-gray-900"
                    ></h2>
                </div>

                <button
                    type="button"
                    onclick="closeLayananModal()"
                    class="flex items-center justify-center w-9 h-9 rounded-full
                           text-gray-500 hover:text-gray-800 hover:bg-gray-100
                           transition"
                    aria-label="Tutup"
                >
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>


            {{-- Isi Modal --}}
            <div class="p-5">

                {{-- Logo --}}
                <div class="w-full h-48 mb-5 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center">
                    <img
                        id="modalLogo"
                        src=""
                        alt=""
                        class="w-full h-full object-contain p-4"
                    >
                </div>


                {{-- Deskripsi --}}
                <div class="mb-6">

                    <h3 class="text-sm font-semibold text-gray-900 mb-2">
                        Tentang layanan
                    </h3>

                    <p
                        id="modalDescription"
                        class="text-sm leading-6 text-gray-600 whitespace-pre-line"
                    ></p>

                </div>


                {{-- Informasi --}}
                <div class="grid grid-cols-2 gap-3 mb-6">

                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-400">
                            Dibuat
                        </p>

                        <p
                            id="modalCreated"
                            class="mt-1 text-sm font-medium text-gray-700"
                        ></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-400">
                            Total pengunjung
                        </p>

                        <p
                            id="modalClicks"
                            class="mt-1 text-sm font-medium text-gray-700"
                        ></p>
                    </div>

                </div>


                {{-- Tombol Kunjungi --}}
                <a
                    id="modalVisit"
                    href="#"
                    target="_blank"
                    class="w-full inline-flex items-center justify-center gap-2
                           px-4 py-3 rounded-lg
                           bg-blue-600 text-white font-medium
                           hover:bg-blue-700 transition"
                >
                    Kunjungi Halaman

                    <svg
                        class="w-4 h-4"
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


    {{-- ========================================================= --}}
    {{-- DATA LAYANAN UNTUK MODAL --}}
    {{-- ========================================================= --}}

    <script>
        const layananData = {
            @foreach ($kategori->groups as $group)
                @foreach ($group->layanans as $item)

                    {{ $item->id }}: {
                        title: @json($item->nama_layanan),
                        creator: @json($item->creator->username),
                        description: @json($item->deskripsi),
                        logo: @json(Storage::url($item->logo ?? 'layanan-logo/gambar.png')),
                        created: @json($item->created_at->diffForHumans()),
                        clicks: @json($item->clicks),
                        visitUrl: @json(route('layanan.visit', $item)),
                    },

                @endforeach
            @endforeach
        };


        function openLayananModal(id) {

            const layanan = layananData[id];

            if (!layanan) {
                return;
            }

            document.getElementById('modalCreator').textContent =
                layanan.creator;

            document.getElementById('modalTitle').textContent =
                layanan.title;

            document.getElementById('modalDescription').textContent =
                layanan.description;

            document.getElementById('modalLogo').src =
                layanan.logo;

            document.getElementById('modalLogo').alt =
                'Logo ' + layanan.title;

            document.getElementById('modalCreated').textContent =
                layanan.created;

            document.getElementById('modalClicks').textContent =
                layanan.clicks;

            document.getElementById('modalVisit').href =
                layanan.visitUrl;


            const modal = document.getElementById('layananModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('overflow-hidden');
        }


        function closeLayananModal() {

            const modal = document.getElementById('layananModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('overflow-hidden');
        }


        // Tutup modal dengan tombol Escape
        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                closeLayananModal();
            }

        });
    </script>

</x-layout>