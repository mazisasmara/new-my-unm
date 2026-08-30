<x-layout>
    <x-slot:title>Tambah Akun Admin</x-slot:title>
    <div class="mx-auto max-w-3xl overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4"><h2 class="font-bold text-slate-800">Informasi Akun dan Unit</h2><p class="text-sm text-slate-500">Satu akun admin akan ditugaskan untuk satu grup pengelola.</p></div>
        @if($errors->any())<div class="m-6 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form action="{{ route('superadmin.admins.store') }}" method="POST" class="space-y-5 p-6">@csrf
            <div class="grid gap-5 sm:grid-cols-2"><div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Username</label><input name="username" value="{{ old('username') }}" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"></div><div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"></div></div>
            <div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label><input type="password" name="password" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"><p class="mt-1 text-xs text-slate-500">Minimal 8 karakter.</p></div>
            <div class="grid gap-5 sm:grid-cols-2"><div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Grup / Unit</label><input name="nama_group" value="{{ old('nama_group') }}" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"></div><div><label class="mb-1.5 block text-sm font-semibold text-slate-700">Kategori</label><select name="kategori_id" required class="w-full rounded-md border border-slate-300 px-3 py-2.5"><option value="">Pilih kategori</option>@foreach($kategoriList as $kategori)<option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>{{ $kategori->nama_kategori }}</option>@endforeach</select></div></div>
            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5"><a href="{{ route('superadmin.admins.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a><button class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Buat Akun</button></div>
        </form>
    </div>
</x-layout>
