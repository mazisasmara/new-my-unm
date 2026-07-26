<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Layanans::with(['unit', 'kategori'])->orderBy('urutan');

        if ($user->isAdmin()) {
            $query->milikFakultas($user->fakultas_id);
        }

        $layanan = $query->get()->groupBy(fn ($item) => $item->unit->nama_unit ?? 'Lainnya');

        return view('admin.layanan.index', compact('layanan'), ['title' => 'Admin']);
    }

    public function edit(Layanan $layanan)
    {
        $this->authorize('update', $layanan);

        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $this->authorize('update', $layanan);

        $data = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi'    => ['nullable', 'string'],
            'link'         => ['nullable', 'url'],
            'logo'         => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logo-layanan', 'public');
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function toggleStatus(Layanan $layanan)
    {
        $this->authorize('update', $layanan);

        $layanan->update(['status' => !$layanan->status]);

        return back()->with('success', 'Status layanan diperbarui.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'ids'   => ['required', 'array'],
            'ids.*' => ['integer', 'exists:layanan,id'],
        ]);

        foreach ($data['ids'] as $index => $id) {
            $layanan = Layanan::findOrFail($id);
            $this->authorize('reorder', $layanan);
            $layanan->update(['urutan' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}