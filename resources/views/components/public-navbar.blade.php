@php
    $menuItems = [
        ['label' => 'Beranda', 'url' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'Fakultas', 'url' => url('fakultas'), 'active' => request()->is('fakultas')],
        ['label' => 'Portal prodi', 'url' => url('portal-prodi'), 'active' => request()->is('portal-prodi')],
        ['label' => 'Mahasiswa', 'url' => url('mahasiswa'), 'active' => request()->is('mahasiswa')],
        ['label' => 'Perpustakaan', 'url' => url('perpustakaan'), 'active' => request()->is('perpustakaan')],
    ];
@endphp

<nav class="sticky top-5 z-50 mx-5 rounded-[30px] border border-white/10 bg-slate-950/90 px-5 py-3 shadow-2xl shadow-slate-950/30 backdrop-blur-xl">
    <div class="mx-auto flex min-h-24 max-w-screen-2xl items-center justify-between gap-5">
        <a href="{{ route('home') }}" class="shrink-0" aria-label="Beranda Universitas Negeri Makassar">
            <img src="{{ asset('storage/layanan-logo/logo-myunm.png') }}" alt="Universitas Negeri Makassar" class="h-20 w-auto object-contain sm:h-24">
        </a>
        <div class="hidden min-w-0 flex-1 flex-col items-end justify-center gap-1 lg:flex">
            @auth
                <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="inline-flex h-10 items-center rounded-full bg-yellow-400 px-5 text-lg font-medium text-slate-950 transition hover:bg-yellow-300">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="inline-flex h-10 items-center gap-2 rounded-full bg-yellow-400 px-5 text-lg font-medium text-slate-950 transition hover:bg-yellow-300"><svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8l4 4m0 0-4 4m4-4H9m4 8H6a2 2 0 01-2-2V6a2 2 0 012-2h7a2 2 0 012 2v2" /></svg>Login</a>
            @endauth
            <div class="flex flex-wrap items-center justify-end gap-1.5 xl:gap-3">
                @foreach ($menuItems as $item)
                    <a href="{{ $item['url'] }}" @class(['rounded-full px-4 py-2 text-lg font-medium transition xl:px-5', 'bg-yellow-400 text-slate-950 shadow-lg shadow-yellow-400/15' => $item['active'], 'text-white hover:bg-white/10 hover:text-yellow-300' => ! $item['active']])>{{ $item['label'] }}</a>
                @endforeach
            </div>
        </div>
        <button type="button" class="inline-flex size-11 items-center justify-center rounded-full text-yellow-400 transition hover:bg-white/10 lg:hidden" onclick="toggleMobileNavbar()" aria-controls="mobile-navbar-menu" aria-expanded="false" id="mobile-navbar-toggle" aria-label="Buka menu navigasi"><svg class="size-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg></button>
    </div>
    <div id="mobile-navbar-menu" class="hidden border-t border-white/10 pt-3 lg:hidden">
        <div class="grid gap-1 rounded-2xl bg-white/5 p-2">
            @foreach ($menuItems as $item)
                <a href="{{ $item['url'] }}" @class(['rounded-xl px-4 py-3 text-base font-medium transition', 'bg-yellow-400 text-slate-950' => $item['active'], 'text-white hover:bg-white/10 hover:text-yellow-300' => ! $item['active']])>{{ $item['label'] }}</a>
            @endforeach
            @auth
                <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="mt-1 inline-flex items-center justify-center rounded-xl bg-yellow-400 px-4 py-3 text-base font-medium text-slate-950 hover:bg-yellow-300">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="mt-1 inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-400 px-4 py-3 text-base font-medium text-slate-950 hover:bg-yellow-300"><svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8l4 4m0 0-4 4m4-4H9m4 8H6a2 2 0 01-2-2V6a2 2 0 012 2v2" /></svg>Login</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    function toggleMobileNavbar() {
        const menu = document.getElementById('mobile-navbar-menu');
        const toggle = document.getElementById('mobile-navbar-toggle');
        menu.classList.toggle('hidden');
        toggle.setAttribute('aria-expanded', String(!menu.classList.contains('hidden')));
    }
</script>
