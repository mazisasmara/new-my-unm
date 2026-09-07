<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function create()
    {
        return view('auth.login', [
            'title' => 'Login',
            'customerServiceEmail' => SiteSetting::valueFor('customer_service_email'),
        ]);
    }

    /**
     * Proses login
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Cek dulu apakah user ada & statusnya aktif
        $user = User::where('username', $credentials['username'])->first();

        if (! $user || ! $user->status) {
            throw ValidationException::withMessages([
                'username' => 'Akun tidak ditemukan atau sudah dinonaktifkan.',
            ]);
        }

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => 'Username atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        return match ($user->role) {
            'admin' => redirect('/admin/dashboard'),
            'superadmin' => redirect('/superadmin/dashboard'),
        };
    }

    /**
     * Logout
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
