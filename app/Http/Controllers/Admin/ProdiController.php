<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function index()
    {
        $this->ensurePortalProdiAdmin();

        return view('admin.prodi.index', [
            'title' => 'Manajemen Portal Prodi',
            'prodis' => Prodi::with(['links', 'group.user', 'creator'])
                ->when(! auth()->user()->isSuperAdmin(), fn ($query) => $query->where('group_id', auth()->user()->group_id))
                ->when(request('search'), fn ($query, $search) => $query->where(fn ($nested) => $nested->where('judul', 'like', "%{$search}%")->orWhereHas('links', fn ($links) => $links->where('label', 'like', "%{$search}%"))))
                ->when(request()->filled('status'), fn ($query) => $query->where('status', request('status')))
                ->when(auth()->user()->isSuperAdmin() && request()->filled('group'), fn ($query) => $query->where('group_id', request('group')))
                ->orderBy('urutan')
                ->get(),
            'groups' => $this->portalGroups(),
        ]);
    }

    public function create()
    {
        $this->ensurePortalProdiAdmin();

        return view('admin.prodi.form', [
            'title' => 'Tambah Portal Prodi',
            'groups' => $this->portalGroups(),
        ]);
    }

    public function store(Request $request)
    {
        $this->ensurePortalProdiAdmin();
        $validated = $this->validateInput($request);
        $this->validateSuperAdminGroup($validated);

        DB::transaction(function () use ($validated) {
            $prodi = Prodi::create([
                'group_id' => auth()->user()->isSuperAdmin() ? $validated['group_id'] : auth()->user()->group_id,
                'created_by' => auth()->id(),
                'judul' => $validated['judul'],
                'status' => $validated['status'] ?? false,
                'urutan' => $validated['urutan'] ?? 0,
            ]);
            $this->syncLinks($prodi, $validated['links']);
        });

        return to_route('admin.prodi.index')->with('success', 'Portal prodi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        $this->authorizeProdi($prodi);

        return view('admin.prodi.form', [
            'title' => 'Edit Portal Prodi',
            'prodi' => $prodi->load('links'),
            'groups' => $this->portalGroups(),
        ]);
    }

    public function update(Request $request, Prodi $prodi)
    {
        $this->authorizeProdi($prodi);
        $validated = $this->validateInput($request);
        $this->validateSuperAdminGroup($validated);

        DB::transaction(function () use ($validated, $prodi) {
            $prodi->update([
                'group_id' => auth()->user()->isSuperAdmin() ? $validated['group_id'] : $prodi->group_id,
                'judul' => $validated['judul'],
                'status' => $validated['status'] ?? false,
                'urutan' => $validated['urutan'] ?? 0,
            ]);
            $this->syncLinks($prodi, $validated['links']);
        });

        return to_route('admin.prodi.index')->with('success', 'Portal prodi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        $this->authorizeProdi($prodi);
        $prodi->delete();

        return back()->with('success', 'Portal prodi berhasil dihapus.');
    }

    private function validateInput(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'group_id' => auth()->user()->isSuperAdmin()
                ? ['required', 'exists:groups,id']
                : ['nullable'],
            'status' => ['nullable', 'boolean'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'links' => ['required', 'array', 'min:1'],
            'links.*.id' => ['nullable', 'integer', 'exists:prodi_links,id'],
            'links.*.label' => ['required', 'string', 'max:255'],
            'links.*.url' => ['required', 'url:http,https', 'max:2048'],
        ]);
    }

    private function syncLinks(Prodi $prodi, array $links): void
    {
        $submittedIds = collect($links)->pluck('id')->filter()->map(fn ($id) => (int) $id);
        abort_if(
            $submittedIds->isNotEmpty() &&
            $prodi->links()->whereIn('id', $submittedIds)->count() !== $submittedIds->count(),
            403
        );

        $savedIds = [];
        foreach (array_values($links) as $index => $link) {
            $saved = $prodi->links()->updateOrCreate(
                ['id' => $link['id'] ?? null],
                ['label' => $link['label'], 'url' => $link['url'], 'urutan' => $index + 1]
            );
            $savedIds[] = $saved->id;
        }

        $prodi->links()->whereNotIn('id', $savedIds)->delete();
    }

    private function ensurePortalProdiAdmin(): void
    {
        if (auth()->user()->isSuperAdmin()) {
            return;
        }

        abort_unless(auth()->user()->group?->kategori?->slug === 'portal-prodi', 403);
    }

    private function authorizeProdi(Prodi $prodi): void
    {
        $this->ensurePortalProdiAdmin();
        if (auth()->user()->isSuperAdmin()) {
            return;
        }

        abort_unless($prodi->group_id === auth()->user()->group_id, 403);
    }

    private function portalGroups()
    {
        if (! auth()->user()->isSuperAdmin()) {
            return collect();
        }

        return Group::with('user')
            ->whereHas('kategori', fn ($query) => $query->where('slug', 'portal-prodi'))
            ->orderBy('nama_group')
            ->get();
    }

    private function validateSuperAdminGroup(array $validated): void
    {
        if (auth()->user()->isSuperAdmin()) {
            abort_unless($this->portalGroups()->contains('id', (int) $validated['group_id']), 422);
        }
    }
}
