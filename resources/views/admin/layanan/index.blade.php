<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Kelola Layanan</h1>

            <a
                href="{{ route('admin.layanan.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
            >
                + Tambah Layanan
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <p class="text-gray-500 text-sm">
                Group:
                <span class="font-medium text-gray-700">
                    {{ auth()->user()->group->nama_group }}
                </span>
            </p>
        </div>

        <ul id="sortable" class="space-y-2">
            @forelse ($layanans as $item)
                <li
                    data-id="{{ $item->id }}"
                    class="flex items-center justify-between bg-white border rounded-lg p-3 shadow-sm"
                >
                    <div class="flex items-center gap-3">
                        <span class="text-gray-400 cursor-move">☰</span>

                        <div>
                            <p class="font-medium">{{ $item->nama_layanan }}</p>

                            <p class="text-xs text-gray-500">
                                {{ $item->clicks }} klik
                            </p>
                        </div>

                        <span
                            class="text-xs px-2 py-1 rounded-full
                            {{ $item->status
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-200 text-gray-600' }}"
                        >
                            {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <form
                            action="{{ route('admin.layanan.toggle', $item) }}"
                            method="POST"
                        >
                            @csrf
                            @method ('PATCH')

                            <button
                                type="submit"
                                class="text-sm text-blue-600 hover:underline"
                            >
                                {{ $item->status ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                        <a
                            href="{{ route('admin.layanan.edit', $item) }}"
                            class="text-sm text-gray-600 hover:underline"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.layanan.destroy', $item) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus layanan ini?')"
                        >
                            @csrf
                            @method ('DELETE')

                            <button
                                type="submit"
                                class="text-sm text-red-600 hover:underline"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li
                    class="bg-white border rounded-lg p-6 text-center text-gray-500"
                >
                    Belum ada layanan.
                </li>
            @endforelse
        </ul>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

    <script>
        new Sortable(document.getElementById('sortable'), {
            animation: 150,

            onEnd() {
                const ids = Array.from(
                    document.querySelectorAll('#sortable li')
                ).map(item => item.dataset.id);

                fetch('{{ route('admin.layanan.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ ids }),
                });
            }
        });
    </script>
</x-layout>
