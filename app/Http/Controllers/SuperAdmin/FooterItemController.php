<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\FooterItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FooterItemController extends Controller
{
    public function index(): View
    {
        return view('superadmin.footer-items.index', [
            'title' => 'Kelola Footer',
            'contacts' => FooterItem::where('type', 'contact')->orderBy('urutan')->get(),
            'socialLinks' => FooterItem::where('type', 'social')->orderBy('urutan')->get(),
        ]);
    }

    public function create(): View
    {
        return view('superadmin.footer-items.form', [
            'title' => 'Tambah Item Footer',
            'footerItem' => new FooterItem,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        FooterItem::create($this->validated($request));

        return redirect()->route('superadmin.footer-items.index')
            ->with('success', 'Item footer berhasil ditambahkan.');
    }

    public function edit(FooterItem $footerItem): View
    {
        return view('superadmin.footer-items.form', [
            'title' => 'Edit Item Footer',
            'footerItem' => $footerItem,
        ]);
    }

    public function update(Request $request, FooterItem $footerItem): RedirectResponse
    {
        $footerItem->update($this->validated($request));

        return redirect()->route('superadmin.footer-items.index')
            ->with('success', 'Item footer berhasil diperbarui.');
    }

    public function destroy(FooterItem $footerItem): RedirectResponse
    {
        $footerItem->delete();

        return back()->with('success', 'Item footer berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'type' => ['required', Rule::in(['contact', 'social'])],
            'label' => ['required', 'string', 'max:100'],
            'value' => [Rule::requiredIf($request->input('type') === 'contact'), 'nullable', 'string', 'max:1000'],
            'url' => [Rule::requiredIf($request->input('type') === 'social'), 'nullable', 'string', 'max:2048', function (string $attribute, mixed $value, \Closure $fail) {
                if ($value !== null && ! preg_match('/^(https?:\/\/|mailto:|tel:)/i', $value)) {
                    $fail('Tautan harus diawali http://, https://, mailto:, atau tel:.');
                }
            }],
            'icon' => ['required', Rule::in(['location', 'email', 'phone', 'youtube', 'instagram', 'facebook', 'whatsapp', 'tiktok', 'linkedin', 'website'])],
            'urutan' => ['required', 'integer', 'min:0', 'max:999'],
            'status' => ['required', 'boolean'],
        ]);

        $data['value'] = $data['type'] === 'social' ? null : $data['value'];

        return $data;
    }
}
