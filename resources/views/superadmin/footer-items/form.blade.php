<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mx-auto max-w-3xl overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
            <h2 class="text-lg font-bold text-slate-800">{{ $footerItem->exists ? 'Edit Item Footer' : 'Tambah Item Footer' }}</h2>
            <p class="text-sm text-slate-500">Informasi aktif akan langsung ditampilkan pada footer publik.</p>
        </div>

        <form action="{{ $footerItem->exists ? route('superadmin.footer-items.update', $footerItem) : route('superadmin.footer-items.store') }}" method="POST" class="space-y-5 p-6">
            @csrf
            @if($footerItem->exists) @method('PUT') @endif

            @if($errors->any())
                <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Jenis</label><select id="footer-type" name="type" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"><option value="contact" @selected(old('type', $footerItem->type) === 'contact')>Informasi kontak</option><option value="social" @selected(old('type', $footerItem->type) === 'social')>Media sosial</option></select></div>
                <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Label</label><input name="label" value="{{ old('label', $footerItem->label) }}" required maxlength="100" placeholder="Contoh: Email atau YouTube" class="w-full rounded-md border border-slate-300 px-3 py-2.5"></div>
            </div>

            <div id="value-field"><label class="mb-1.5 block text-sm font-semibold text-slate-700">Isi informasi</label><textarea name="value" rows="3" maxlength="1000" placeholder="Alamat, alamat email, atau nomor telepon" class="w-full rounded-md border border-slate-300 px-3 py-2.5">{{ old('value', $footerItem->value) }}</textarea></div>
            <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Tautan <span id="url-required" class="text-red-600">*</span></label><input name="url" value="{{ old('url', $footerItem->url) }}" maxlength="2048" placeholder="https://..., mailto:..., atau tel:..." class="w-full rounded-md border border-slate-300 px-3 py-2.5"><p class="mt-1 text-xs text-slate-500">Wajib untuk media sosial; opsional untuk informasi kontak.</p></div>

            <div class="grid gap-5 sm:grid-cols-3">
                <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Ikon</label><select name="icon" required class="w-full rounded-md border border-slate-300 px-3 py-2.5">@foreach(['location' => 'Lokasi', 'email' => 'Email', 'phone' => 'Telepon', 'youtube' => 'YouTube', 'instagram' => 'Instagram', 'facebook' => 'Facebook', 'whatsapp' => 'WhatsApp', 'tiktok' => 'TikTok', 'linkedin' => 'LinkedIn', 'website' => 'Website'] as $value => $label)<option value="{{ $value }}" @selected(old('icon', $footerItem->icon) === $value)>{{ $label }}</option>@endforeach</select></div>
                <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Urutan</label><input type="number" min="0" max="999" name="urutan" value="{{ old('urutan', $footerItem->urutan ?? 0) }}" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"></div>
                <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Status</label><select name="status" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"><option value="1" @selected((string) old('status', (int) ($footerItem->status ?? true)) === '1')>Aktif</option><option value="0" @selected((string) old('status', (int) ($footerItem->status ?? true)) === '0')>Nonaktif</option></select></div>
            </div>

            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5"><a href="{{ route('superadmin.footer-items.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a><button class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Simpan</button></div>
        </form>
    </div>

    <script>
        const typeInput = document.getElementById('footer-type');
        const valueField = document.getElementById('value-field');
        const valueInput = valueField.querySelector('[name="value"]');
        const urlInput = document.querySelector('[name="url"]');
        const urlRequired = document.getElementById('url-required');
        function syncTypeFields() {
            const social = typeInput.value === 'social';
            valueField.classList.toggle('hidden', social);
            valueInput.required = !social;
            urlInput.required = social;
            urlRequired.classList.toggle('hidden', !social);
        }
        typeInput.addEventListener('change', syncTypeFields);
        syncTypeFields();
    </script>
</x-layout>
