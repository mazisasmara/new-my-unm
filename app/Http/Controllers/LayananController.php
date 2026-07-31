<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Pages
    |--------------------------------------------------------------------------
    */

    public function kategori($slug = 'universitas')
{
    $kategori = Kategori::where('slug', $slug)
        ->with(['groups.layanans' => function ($query) {
            $query->where('status', true)
                  ->orderBy('urutan');
        }])
        ->firstOrFail();

    return view('layanan', [
        'title' => $kategori->nama_kategori,
        'kategori' => $kategori,
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | Admin Panel
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $layanans = Layanan::with('group')
                ->orderBy('urutan')
                ->get();
        } else {
            $layanans = Layanan::with('group')
                ->where('group_id', $user->group_id)
                ->orderBy('urutan')
                ->get();
        }

        return view('admin.layanan.index', [
            'title' => 'Manajemen Layanan',
            'layanans' => $layanans,
        ]);
    }

    public function create()
    {
        return view('admin.layanan.create', [
            'title' => 'Tambah Layanan',
        ]);
    }

    public function store(Request $request)
    {
       
    $rules = [
        'nama_layanan' => ['required', 'string', 'max:255'],
        'deskripsi' => ['nullable', 'string'],
        'link' => ['nullable', 'url'],
        'urutan' => ['nullable', 'integer'],
        'status' => ['nullable', 'boolean'],
        'logo' => ['nullable', 'image', 'max:2048'],
    ];

    if (auth()->user()->isSuperAdmin()) {
        $rules['group_id'] = ['required', 'exists:groups,id'];
    }

    $validated = $request->validate($rules);

    $groupId = auth()->user()->isSuperAdmin()
        ? $validated['group_id']
        : auth()->user()->group_id;

    $logoPath = null;

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')
            ->store('layanan-logo', 'public');
    }

    Layanan::create([
        'group_id' => $groupId,
        'created_by' => auth()->id(),
        'nama_layanan' => $validated['nama_layanan'],
        'logo' => $logoPath,
        'deskripsi' => $validated['deskripsi'] ?? null,
        'link' => $validated['link'] ?? null,
        'urutan' => $validated['urutan'] ?? 0,
        'status' => $validated['status'] ?? true,
    ]);

    return redirect()
        ->route('admin.layanan.index')
        ->with('success', 'Layanan berhasil ditambahkan.');

    }

    public function show(Layanan $layanan)
    {
        //
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', [
            'title' => 'Edit Layanan',
            'layanan' => $layanan,
        ]);
    }

    public function update(Request $request, Layanan $layanan)
    {
    if (
        auth()->user()->isAdmin() &&
        $layanan->group_id !== auth()->user()->group_id
    ) {
        abort(403);
    }

    $rules = [
        'nama_layanan' => ['required', 'string', 'max:255'],
        'deskripsi' => ['nullable', 'string'],
        'link' => ['nullable', 'url'],
        'urutan' => ['nullable', 'integer'],
        'status' => ['nullable', 'boolean'],
        'logo' => ['nullable', 'image', 'max:2048'],
    ];

    if (auth()->user()->isSuperAdmin()) {
        $rules['group_id'] = ['required', 'exists:groups,id'];
    }

    $validated = $request->validate($rules);

    $data = [
        'nama_layanan' => $validated['nama_layanan'],
        'deskripsi' => $validated['deskripsi'] ?? null,
        'link' => $validated['link'] ?? null,
        'urutan' => $validated['urutan'] ?? 0,
        'status' => $validated['status'] ?? true,
    ];

    if (auth()->user()->isSuperAdmin()) {
        $data['group_id'] = $validated['group_id'];
    }

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')
            ->store('layanan-logo', 'public');
    }

    $layanan->update($data);

    return redirect()
        ->route('admin.layanan.index')
        ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
    if (
        auth()->user()->isAdmin() &&
        $layanan->group_id !== auth()->user()->group_id
    ) {
        abort(403);
    }

    $layanan->delete();

    return back()->with(
        'success',
        'Layanan berhasil dihapus.'
    );
    }

    public function toggleStatus(Layanan $layanan)
    {
        $layanan->update([
            'status' => !$layanan->status,
        ]);

        return back();
    }

    public function reorder(Request $request)
    {
        //
    }
}