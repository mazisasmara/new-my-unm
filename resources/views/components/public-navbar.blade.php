@php
    $menuItems = [
        ['label' => 'Beranda', 'url' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'Fakultas', 'url' => url('fakultas'), 'active' => request()->is('fakultas')],
        ['label' => 'Portal Prodi', 'url' => url('portal-prodi'), 'active' => request()->is('portal-prodi')],
        ['label' => 'Mahasiswa', 'url' => url('mahasiswa'), 'active' => request()->is('mahasiswa')],
        ['label' => 'Perpustakaan', 'url' => url('perpustakaan'), 'active' => request()->is('perpustakaan')],
    ];
@endphp

<nav class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 px-4 backdrop-blur-xl sm:px-6 lg:px-8">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-5">
        <a href="{{ route('home') }}" class="flex h-16 shrink-0 items-center rounded-2xl bg-[#0F1B3D] px-3 shadow-sm" aria-label="Beranda Universitas Negeri Makassar">
            <img src="{{ asset('storage/layanan-logo/logo-myunm.png') }}" alt="Universitas Negeri Makassar" class="h-12 w-auto object-contain sm:h-14">
        </a>
        <div class="hidden min-w-0 items-center gap-5 lg:flex xl:gap-8">
            <div class="flex items-center gap-1 xl:gap-2">
                @foreach ($menuItems as $item)
                    <a href="{{ $item['url'] }}" @class(['relative rounded-lg px-3 py-2 text-sm font-medium transition', 'text-[#0F1B3D] after:absolute after:inset-x-3 after:-bottom-1 after:h-0.5 after:rounded-full after:bg-[#FFC400]' => $item['active'], 'text-slate-600 hover:bg-slate-50 hover:text-[#0F1B3D]' => ! $item['active']])>{{ $item['label'] }}</a>
                @endforeach
            </div>
            @auth
                <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="inline-flex h-11 items-center rounded-full bg-[#FFC400] px-5 text-sm font-semibold text-[#0F1B3D] transition hover:bg-yellow-300">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="inline-flex h-11 items-center gap-2 rounded-full bg-[#0F1B3D] px-5 text-sm font-semibold text-white transition hover:bg-[#182955]"><svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8l4 4m0 0-4 4m4-4H9m4 8H6a2 2 0 01-2-2V6a2 2 0 012-2h7a2 2 0 012 2v2" /></svg>Login</a>
            @endauth
        </div>
        <button type="button" class="inline-flex size-11 items-center justify-center rounded-full text-[#0F1B3D] transition hover:bg-slate-100 lg:hidden" onclick="toggleMobileNavbar()" aria-controls="mobile-navbar-menu" aria-expanded="false" id="mobile-navbar-toggle" aria-label="Buka menu navigasi"><svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg></button>
    </div>
    <div id="mobile-navbar-menu" class="mx-auto hidden max-w-7xl border-t border-slate-100 pb-4 pt-3 lg:hidden">
        <div class="grid gap-1 rounded-2xl bg-slate-50 p-2">
            @foreach ($menuItems as $item)
                <a href="{{ $item['url'] }}" @class(['rounded-xl px-4 py-3 text-base font-medium transition', 'bg-[#FFC400] text-[#0F1B3D]' => $item['active'], 'text-slate-600 hover:bg-white hover:text-[#0F1B3D]' => ! $item['active']])>{{ $item['label'] }}</a>
            @endforeach
            @auth
                <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="mt-1 inline-flex items-center justify-center rounded-xl bg-[#0F1B3D] px-4 py-3 text-base font-medium text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="mt-1 inline-flex items-center justify-center gap-2 rounded-xl bg-[#0F1B3D] px-4 py-3 text-base font-medium text-white"><svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8l4 4m0 0-4 4m4-4H9m4 8H6a2 2 0 01-2-2V6a2 2 0 012-2h7a2 2 0 012 2v2" /></svg>Login</a>
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
