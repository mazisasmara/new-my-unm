<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Kelola Footer</h2>
            <p class="text-sm text-slate-500">Kelola informasi kontak dan tautan media sosial pada footer aplikasi.</p>
        </div>
        <a href="{{ route('superadmin.footer-items.create') }}" class="rounded-md bg-blue-600 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-700">+ Tambah Item</a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    @foreach([['Informasi Kontak', $contacts], ['Media Sosial', $socialLinks]] as [$heading, $items])
        <section class="mb-6 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-5 py-4"><h3 class="font-bold text-slate-800">{{ $heading }}</h3></div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
                        <tr><th class="px-5 py-3">Urutan</th><th class="px-5 py-3">Label</th><th class="px-5 py-3">Isi / Tautan</th><th class="px-5 py-3">Ikon</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Aksi</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($items as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-4">{{ $item->urutan }}</td>
                                <td class="px-5 py-4 font-semibold text-slate-800">{{ $item->label }}</td>
                                <td class="max-w-md px-5 py-4 text-slate-600"><p class="break-words">{{ $item->value ?: $item->url }}</p>@if($item->value && $item->url)<p class="mt-1 break-all text-xs text-blue-600">{{ $item->url }}</p>@endif</td>
                                <td class="px-5 py-4 capitalize">{{ $item->icon }}</td>
                                <td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">{{ $item->status ? 'Aktif' : 'Nonaktif' }}</span></td>
                                <td class="px-5 py-4"><div class="flex justify-end gap-2"><a href="{{ route('superadmin.footer-items.edit', $item) }}" class="rounded bg-amber-500 px-2.5 py-1.5 text-xs font-semibold text-white">Edit</a><form action="{{ route('superadmin.footer-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus item footer ini?')">@csrf @method('DELETE')<button class="rounded bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white">Hapus</button></form></div></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-10 text-center text-slate-500">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    @endforeach
</x-layout>
