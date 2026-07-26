<x-layout>
      <x-slot:title>{{ $title }}</x-slot:title>

<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Kelola Layanan</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    @foreach ($layanan as $namaUnit => $items)
        <div class="mb-8">
            <h2 class="font-semibold text-lg mb-3">{{ $namaUnit }}</h2>
            <ul id="sortable-{{ Str::slug($namaUnit) }}" class="space-y-2">
                @foreach ($items as $item)
                    <li data-id="{{ $item->id }}"
                        class="flex items-center justify-between bg-white border rounded-lg p-3 cursor-move shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="text-gray-400">☰</span>
                            <span>{{ $item->nama_layanan }}</span>
                            <span class="text-xs px-2 py-0.5 rounded {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-500' }}">
                                {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <form action="{{ route('admin.layanan.toggle', $item) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="text-sm text-blue-600 hover:underline">
                                    {{ $item->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            <a href="{{ route('admin.layanan.edit', $item) }}" class="text-sm text-gray-600 hover:underline">Edit</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
<script>
document.querySelectorAll('[id^="sortable-"]').forEach(function (list) {
    new Sortable(list, {
        animation: 150,
        onEnd: function () {
            const ids = Array.from(list.children).map(li => li.dataset.id);
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
});
</script>
</x-layout>