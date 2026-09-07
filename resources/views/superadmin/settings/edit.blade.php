<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-800">Pengaturan</h2>
        <p class="text-sm text-slate-500">Kelola informasi yang digunakan pada halaman login.</p>
    </div>

    <section class="max-w-2xl rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-5 py-4">
            <h3 class="font-bold text-slate-800">Kontak Customer Service</h3>
            <p class="mt-1 text-sm text-slate-500">Tombol “Hubungi Tim Support” akan membuka Gmail dengan alamat ini sebagai penerima.</p>
        </div>

        <form method="POST" action="{{ route('superadmin.settings.update') }}" class="space-y-5 p-5">
            @csrf
            @method('PUT')

            @if(session('success'))
                <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif

            <div>
                <label for="customer_service_email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email CS</label>
                <input id="customer_service_email" type="email" name="customer_service_email" value="{{ old('customer_service_email', $customerServiceEmail) }}" required placeholder="support@unm.ac.id" class="w-full rounded-md border border-slate-300 px-3 py-2.5 focus:border-orange-500 focus:ring-orange-500">
                @error('customer_service_email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end">
                <button class="rounded-md bg-orange-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-orange-700">Simpan Pengaturan</button>
            </div>
        </form>
    </section>
</x-layout>
