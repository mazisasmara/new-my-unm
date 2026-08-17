<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-3xl mx-auto py-8 px-4">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Atur Urutan Group
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Atur posisi group yang akan ditampilkan pada halaman utama.
            </p>
        </div>


        {{-- Pilih Kategori --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-5">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Kategori
            </label>

            <select
                onchange="changeKategori(this.value)"
                class="w-full border border-gray-300 rounded-lg px-3 py-2"
            >
                <option value="">
                    Pilih kategori
                </option>

                @foreach ($kategoris as $kategori)

                    <option
                        value="{{ $kategori->id }}"
                        {{ $kategoriId == $kategori->id ? 'selected' : '' }}
                    >
                        {{ $kategori->nama_kategori }}
                    </option>

                @endforeach
            </select>

        </div>


        @if ($kategoriId)

            {{-- Daftar Group --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">

                <div class="p-5 border-b">

                    <h2 class="font-semibold text-gray-800">
                        Urutan Group
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Geser group untuk mengubah urutan.
                    </p>

                </div>


                <div
                    id="groupList"
                    class="divide-y"
                >

                    @forelse ($groups as $group)

                        <div
                            draggable="true"
                            data-id="{{ $group->id }}"
                            class="group-item flex items-center gap-4 p-4
                                   cursor-move bg-white
                                   hover:bg-gray-50 transition"
                        >

                            {{-- Drag Icon --}}
                            <div class="text-gray-400 text-xl">
                                ☰
                            </div>


                            {{-- Nomor --}}
                            <div
                                class="group-number flex items-center justify-center
                                       w-8 h-8 rounded-full bg-gray-100
                                       text-sm font-semibold text-gray-600"
                            >
                                {{ $loop->iteration }}
                            </div>


                            {{-- Nama --}}
                            <div class="flex-1">

                                <p class="font-medium text-gray-800">
                                    {{ $group->nama_group }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    Urutan database: {{ $group->urutan }}
                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="p-8 text-center text-gray-500">
                            Belum ada group pada kategori ini.
                        </div>

                    @endforelse

                </div>


                @if ($groups->count())

                    <div class="p-5 border-t">

                        <button
                            type="button"
                            onclick="saveOrder()"
                            class="w-full px-4 py-3 rounded-lg
                                   bg-blue-600 text-white font-medium
                                   hover:bg-blue-700 transition"
                        >
                            Simpan Urutan
                        </button>

                    </div>

                @endif

            </div>

        @endif

    </div>


    <script>

        function changeKategori(id) {

            if (!id) {
                return;
            }

            window.location.href =
                "{{ route('superadmin.groups.order') }}?kategori=" + id;
        }


        const groupList = document.getElementById('groupList');

        let draggedItem = null;


        if (groupList) {

            groupList.addEventListener('dragstart', function(event) {

                draggedItem = event.target.closest('.group-item');

                draggedItem.classList.add('opacity-50');

            });


            groupList.addEventListener('dragend', function(event) {

                if (draggedItem) {
                    draggedItem.classList.remove('opacity-50');
                }

                draggedItem = null;

                updateNumbers();

            });


            groupList.addEventListener('dragover', function(event) {

                event.preventDefault();

                const target =
                    event.target.closest('.group-item');

                if (!target || target === draggedItem) {
                    return;
                }


                const rect =
                    target.getBoundingClientRect();

                const middle =
                    rect.top + rect.height / 2;


                if (event.clientY < middle) {

                    groupList.insertBefore(
                        draggedItem,
                        target
                    );

                } else {

                    groupList.insertBefore(
                        draggedItem,
                        target.nextSibling
                    );

                }

            });

        }


        function updateNumbers() {

            document
                .querySelectorAll('.group-item')
                .forEach((item, index) => {

                    const number =
                        item.querySelector('.group-number');

                    number.textContent =
                        index + 1;

                });

        }


        async function saveOrder() {

            const ids = Array.from(
                document.querySelectorAll('.group-item')
            ).map(item => item.dataset.id);


            const response = await fetch(
                "{{ route('superadmin.groups.reorder') }}",
                {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN":
                            "{{ csrf_token() }}"
                    },

                    body: JSON.stringify({
                        kategori_id: "{{ $kategoriId }}",
                        ids: ids
                    })
                }
            );


            const data = await response.json();


            if (data.success) {

                alert('Urutan group berhasil disimpan.');

                location.reload();

            } else {

                alert('Gagal menyimpan urutan.');

            }

        }

    </script>

</x-layout>