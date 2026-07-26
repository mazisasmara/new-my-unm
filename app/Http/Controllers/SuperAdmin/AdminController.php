<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->with('fakultas')->get();

        return view('superadmin.admins.index', compact('admins'), ['title' => 'Super Admin']);
    }

    public function create()
    {
        $fakultasList = Fakultas::all();
        $unitList = Unit::all();

        return view('superadmin.admins.create', compact('fakultasList', 'unitList'), ['title' => 'Super Admin']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username'    => ['required', 'string', 'unique:users,username'],
            'email'       => ['required', 'email', 'unique:users,email'],
            'password'    => ['required', 'string', 'min:8'],
            'fakultas_id' => ['required', 'exists:fakultas,id'],
            'unit_id'     => ['nullable', 'exists:unit,id'],
        ]);

        User::create([
            'username'    => $data['username'],
            'email'       => $data['email'],
            'password'    => Hash::make($data['password']),
            'role'        => 'admin', // dikunci — tidak bisa jadi superadmin dari form ini
            'fakultas_id' => $data['fakultas_id'],
            'unit_id'     => $data['unit_id'] ?? null,
            'status'      => true,
        ]);

        return redirect()->route('superadmin.admins.index')->with('success', 'Akun admin berhasil dibuat.');
    }

    public function destroy(User $user)
    {
        abort_if($user->role !== 'admin', 403, 'Hanya akun admin yang bisa dihapus dari sini.');

        $user->delete();

        return back()->with('success', 'Akun admin dihapus.');
    }
}