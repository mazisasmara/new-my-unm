<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function adminDashboard()
    {
      $layanans = Layanan::with('group')
          ->whereBelongsTo(auth()->user()->group)
          ->orderBy('urutan')
          ->get();
      
      $stats = [
          'total_layanan' => $layanans->count(),
          'layanan_aktif' => ($layanans)->where('status', true)->count(),
          'layanan_nonaktif' => ($layanans)->where('status', false)->count(),
          'total_click' => ($layanans)->sum('clicks'),
      ];
      
      $popularLayanans = Layanan::popular()
          ->whereBelongsTo(auth()->user()->group)
          ->take(5)
          ->get();
          
      return view('admin.dashboard', [
          'title' => 'dashboard Admin',
          'layanans' => $layanans,
          'stats' => $stats,
          'popularLayanans' => $popularLayanans,
      ]);
    }
    
    public function index()
    {
        $layanans = Layanan::with('group')
            ->whereBelongsTo(auth()->user()->group)
            ->orderBy('urutan')
            ->get();

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
        $validated = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'link' => ['nullable', 'url'],
            'urutan' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request
                ->file('logo')
                ->store('layanan-logo', 'public');
        }

        Layanan::create([
            ...$validated,
            'group_id' => auth()->user()->group_id,
            'created_by' => auth()->id(),
            'status' => $validated['status'] ?? true,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return to_route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        $this->authorizeLayanan($layanan);

        return view('admin.layanan.edit', [
            'title' => 'Edit Layanan',
            'layanan' => $layanan,
        ]);
    }

    public function update(Request $request, Layanan $layanan)
    {
        $this->authorizeLayanan($layanan);

        $validated = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'link' => ['nullable', 'url'],
            'urutan' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

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
            'status' => $validated['status'] ?? true,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return to_route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $this->authorizeLayanan($layanan);
        
        if ($layanan->logo) {
            Storage::disk('public')->delete($layanan->logo);
        }

        $layanan->delete();

        return back()->with(
            'success',
            'Layanan berhasil dihapus.'
        );
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
        abort_unless(
            $layanan->group_id === auth()->user()->group_id,
            403
        );
    }
}
