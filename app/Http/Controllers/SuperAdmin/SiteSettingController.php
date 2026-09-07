<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        return view('superadmin.settings.edit', [
            'title' => 'Pengaturan',
            'customerServiceEmail' => SiteSetting::valueFor('customer_service_email'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_service_email' => ['required', 'email', 'max:255'],
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'customer_service_email'],
            ['value' => $data['customer_service_email']],
        );

        return to_route('superadmin.settings.edit')
            ->with('success', 'Email customer service berhasil diperbarui.');
    }
}
