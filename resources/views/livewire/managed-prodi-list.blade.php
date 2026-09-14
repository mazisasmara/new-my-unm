<div wire:poll.visible.10s>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-5 py-3">Judul</th>@if(auth()->user()->isSuperAdmin())<th class="px-5 py-3">Pemilik</th>@endif<th class="px-5 py-3">Tautan dan Klik</th><th class="px-5 py-3">Total Klik</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Aksi</th></tr></thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($prodis as $prodi)
                        <tr><td class="px-5 py-4 font-semibold text-slate-800">{{ $prodi->judul }}</td>@if(auth()->user()->isSuperAdmin())<td class="px-5 py-4"><p class="font-medium">{{ $prodi->group?->nama_group ?? '-' }}</p><p class="text-xs text-slate-500">Admin: {{ $prodi->group?->user?->username ?? 'belum ditugaskan' }} · Pembuat: {{ $prodi->creator?->username ?? '-' }}</p></td>@endif<td class="px-5 py-4 text-slate-500"><ul class="space-y-1">@foreach($prodi->links as $link)<li>{{ $link->label }} <span class="text-xs text-blue-700">({{ $link->clicks }} klik)</span></li>@endforeach</ul></td><td class="px-5 py-4 font-bold text-slate-700">{{ $prodi->links->sum('clicks') }}</td><td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $prodi->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $prodi->status ? 'Aktif' : 'Nonaktif' }}</span></td><td class="px-5 py-4"><div class="flex justify-end gap-3"><a href="{{ route('admin.prodi.edit', $prodi) }}" class="rounded bg-amber-500 px-2.5 py-1.5 text-xs font-semibold text-white">Edit</a><form action="{{ route('admin.prodi.destroy', $prodi) }}" method="POST" onsubmit="return confirm('Hapus portal prodi ini?')">@csrf @method('DELETE')<button class="rounded bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white">Hapus</button></form></div></td></tr>
                    @empty
                        <tr><td colspan="{{ auth()->user()->isSuperAdmin() ? 6 : 5 }}" class="px-5 py-12 text-center text-slate-500">Tidak ada Portal Prodi yang sesuai dengan filter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

</div>
