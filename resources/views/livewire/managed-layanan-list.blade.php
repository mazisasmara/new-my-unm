<div wire:poll.visible.10s>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase text-slate-500"><tr><th class="px-4 py-3">Layanan</th>@if(auth()->user()->isSuperAdmin())<th class="px-4 py-3">Pemilik</th><th class="px-4 py-3">Dibuat oleh</th>@endif<th class="px-4 py-3">Klik</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Aksi</th></tr></thead>
                <tbody id="sortable" class="divide-y divide-slate-100">
                    @forelse($layanans as $item)
                        <tr data-id="{{ $item->id }}" class="hover:bg-slate-50">
                            <td class="px-4 py-3"><div class="flex items-center gap-3"><span class="cursor-move text-slate-400">☰</span><img src="{{ Storage::url($item->logo ?: 'layanan-logo/gambar.png') }}" class="size-10 rounded-md border object-contain" alt=""><div><p class="font-semibold text-slate-800">{{ $item->nama_layanan }}</p><p class="text-xs text-slate-500">{{ $item->group?->kategori?->nama_kategori }}</p></div></div></td>
                            @if(auth()->user()->isSuperAdmin())<td class="px-4 py-3"><p class="fon
                                t-medium">{{ $item->group?->nama_group ?? '-' }}</p><p class="text-xs text-slate-500">Admin: {{ $item->group?->user?->username ?? 'belum ditugaskan' }}</p></td><td class="px-4 py-3 text-slate-600">{{ $item->creator?->username ?? '-' }}</td>@endif
                            <td class="px-4 py-3 font-semibold">{{ number_format($item->clicks) }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">{{ $item->status ? 'Aktif' : 'Nonaktif' }}</span></td>
                            <td class="px-4 py-3"><div class="flex justify-end gap-2"><form action="{{ route('admin.layanan.toggle', $item) }}" method="POST">@csrf @method('PATCH')<button class="rounded border border-slate-300 px-2.5 py-1.5 text-xs font-semibold">{{ $item->status ? 'Nonaktifkan' : 'Aktifkan' }}</button></form><a href="{{ route('admin.layanan.edit', $item) }}" class="rounded bg-amber-500 px-2.5 py-1.5 text-xs font-semibold text-white">Edit</a><form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">@csrf @method('DELETE')<button class="rounded bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white">Hapus</button></form></div></td>
                        </tr>
                    @empty<tr><td colspan="{{ auth()->user()->isSuperAdmin() ? 6 : 4 }}" class="px-5 py-12 text-center text-slate-500">Tidak ada layanan yang sesuai dengan filter.</td></tr>@endforelse
                </tbody>
            </table>
        </div>

</div>
