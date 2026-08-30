<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Prodi;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminDashboard(AnalyticsService $analyticsService)
    {
        if (auth()->user()->group?->kategori?->slug === 'portal-prodi') {
            $prodis = Prodi::with('links')
                ->withCount('links')
                ->where('group_id', auth()->user()->group_id)
                ->orderBy('urutan')
                ->get();

            $days = (int) request('days', 7);
            $days = in_array($days, [7, 14, 30]) ? $days : 7;
            $links = $prodis->flatMap->links;

            return view('admin.prodi.dashboard', [
                'title' => 'Dashboard Admin Prodi',
                'prodis' => $prodis,
                'totalLinks' => $prodis->sum('links_count'),
                'totalClicks' => $links->sum('clicks'),
                'popularLinks' => $links->sortByDesc('clicks')->take(5),
                'analytics' => $analyticsService->prodiLinkVisits($links, $days),
                'days' => $days,
            ]);
        }

        $layanans = Layanan::with('group')
            ->whereBelongsTo(auth()->user()->group)
            ->orderBy('urutan')
            ->get();

        $stats = [
            'total_layanan' => $layanans->count(),
            'layanan_aktif' => $layanans->where('status', true)->count(),
            'layanan_nonaktif' => $layanans->where('status', false)->count(),
            'total_click' => $layanans->sum('clicks'),
        ];

        $days = (int) request('days', 7);

        if (! in_array($days, [7, 14, 30])) {
            $days = 7;
        }

        $analytics = $analyticsService->serviceVisits($layanans, $days);

        $popularLayanans = Layanan::popular()
            ->whereBelongsTo(auth()->user()->group)
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'title' => 'Dashboard Admin',
            'layanans' => $layanans,
            'stats' => $stats,
            'popularLayanans' => $popularLayanans,
            'analytics' => $analytics,
            'days' => $days,
        ]);
    }

    public function index()
    {
        $layanans = Layanan::with(['group.kategori', 'group.user', 'creator'])
            ->when(! auth()->user()->isSuperAdmin(), fn ($query) => $query->whereBelongsTo(auth()->user()->group))
            ->filter(request('search'))
            ->when(request()->filled('status'), fn ($query) => $query->where('status', request('status')))
            ->when(auth()->user()->isSuperAdmin() && request()->filled('group'), fn ($query) => $query->where('group_id', request('group')))
            ->when(auth()->user()->isSuperAdmin() && request()->filled('kategori'), fn ($query) => $query->whereHas('group', fn ($group) => $group->where('kategori_id', request('kategori'))))
            ->orderBy('urutan')
            ->get();

        return view('admin.layanan.index', [
            'title' => 'Manajemen Layanan',
            'layanans' => $layanans,
            'groups' => $this->serviceGroups(),
            'kategoris' => auth()->user()->isSuperAdmin()
                ? Kategori::where('slug', '!=', 'portal-prodi')->orderBy('urutan')->get()
                : collect(),
        ]);
    }

    public function create()
    {
        return view('admin.layanan.create', [
            'title' => 'Tambah Layanan',
            'groups' => $this->serviceGroups(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_id' => ['nullable', 'exists:groups,id'],
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'link' => ['nullable', 'url'],
            'urutan' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if (auth()->user()->isSuperAdmin()) {
            $request->validate(['group_id' => ['required', 'exists:groups,id']]);
            abort_unless($this->serviceGroups()->contains('id', (int) $validated['group_id']), 422);
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request
                ->file('logo')
                ->store('layanan-logo', 'public');
        }

        Layanan::create([
            ...$validated,
            'group_id' => auth()->user()->isSuperAdmin() ? $validated['group_id'] : auth()->user()->group_id,
            'created_by' => auth()->id(),
            'status' => $validated['status'] ?? true,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return to_route('admin.layanan.index')->with(
            'success',
            'Layanan berhasil ditambahkan.'
        );
    }

    public function edit(Layanan $layanan)
    {
        $this->authorizeLayanan($layanan);

        return view('admin.layanan.edit', [
            'title' => 'Edit Layanan',
            'layanan' => $layanan,
            'groups' => $this->serviceGroups(),
        ]);
    }

    public function update(Request $request, Layanan $layanan)
    {
        $this->authorizeLayanan($layanan);

        $validated = $request->validate([
            'group_id' => ['nullable', 'exists:groups,id'],
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'link' => ['nullable', 'url'],
            'urutan' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if (auth()->user()->isSuperAdmin()) {
            $request->validate(['group_id' => ['required', 'exists:groups,id']]);
            abort_unless($this->serviceGroups()->contains('id', (int) $validated['group_id']), 422);
        }

        if ($request->hasFile('logo')) {
            if ($layanan->logo) {
                Storage::disk('public')->delete($layanan->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('layanan-logo', 'public');
        }

        $layanan->update([
            ...$validated,
            'group_id' => auth()->user()->isSuperAdmin() ? $validated['group_id'] : $layanan->group_id,
            'status' => $validated['status'] ?? true,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return to_route('admin.layanan.index')->with(
            'success',
            'Layanan berhasil diperbarui.'
        );
    }

    public function destroy(Layanan $layanan)
    {
        $this->authorizeLayanan($layanan);

        if ($layanan->logo) {
            Storage::disk('public')->delete($layanan->logo);
        }

        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array'],
        ]);

        collect($request->ids)->each(function ($id, $index) {
            Layanan::whereKey($id)
                ->whereBelongsTo(auth()->user()->group)
                ->update([
                    'urutan' => $index + 1,
                ]);
        });

        return response()->json([
            'success' => true,
        ]);
    }

    public function toggleStatus(Layanan $layanan)
    {
        $this->authorizeLayanan($layanan);

        $layanan->update([
            'status' => ! $layanan->status,
        ]);

        return back();
    }

    private function authorizeLayanan(Layanan $layanan): void
    {
        if (auth()->user()->isSuperAdmin()) {
            return;
        }

        abort_unless($layanan->group_id === auth()->user()->group_id, 403);
    }

    private function serviceGroups()
    {
        if (! auth()->user()->isSuperAdmin()) {
            return collect();
        }

        return Group::with(['kategori', 'user'])
            ->whereHas('kategori', fn ($query) => $query->where('slug', '!=', 'portal-prodi'))
            ->orderBy('nama_group')
            ->get();
    }
}
