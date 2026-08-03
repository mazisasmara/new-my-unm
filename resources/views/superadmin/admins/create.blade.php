<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-lg mx-auto py-8 px-4">
        <h1 class="text-xl font-bold mb-6">Tambah Akun Admin</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('superadmin.admins.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Username</label>
                <input
                    type="text"
                    name="username"
                    class="w-full border rounded-md p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    class="w-full border rounded-md p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-md p-2"
                    required
                />
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Group</label>
                <input
                    type="text"
                    name="nama_group"
                    class="w-full border rounded-md p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Kategori</label>
                <select
                    name="kategori_id"
                    class="w-full border rounded-md p-2"
                    required
                >
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoriList as $k)
                        <option value="{{ $k->id }}">
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700"
            >
                Buat Akun
            </button>
        </form>
    </div>
</x-layout>
