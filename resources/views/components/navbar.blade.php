<button type="button" onclick="toggleSidebar()" class="fixed left-4 top-4 z-40 rounded-xl bg-blue-900 p-2.5 text-white shadow-lg md:hidden" aria-label="Buka menu">
    <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
</button>
<div id="sidebar-backdrop" onclick="toggleSidebar(true)" class="fixed inset-0 z-40 hidden bg-slate-950/55 md:hidden"></div>
<aside id="app-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col bg-yellow-500 text-white shadow-2xl transition-transform duration-200 md:translate-x-0">
    <div class="flex h-20 items-center gap-3 border-b border-white/10 px-5">
        <img
        src="{{ asset('storage/layanan-logo/logo-put.png') }}" 
        class="flex w-53 items-center justify-center rounded-xl font-black text-blue-950"></img>
        <button type="button" onclick="toggleSidebar(true)" class="ml-auto p-2 text-black md:hidden" aria-label="Tutup menu">✕</button>
    </div>
    <nav class="flex-1 overflow-y-auto px-4 py-5">
        <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-widest text-black">Referensi Arsip</p>
        <div class="space-y-1">
            @foreach($kategoris as $item)
                @php
                    $href = $item->slug === 'universitas' ? route('home') : url($item->slug);
                    $active = $item->slug === 'universitas' ? request()->is('/') : request()->is($item->slug);
                @endphp
                <a href="{{ $href }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-white text-yellow-300 shadow' : 'text-white hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">{{ $item->nama_kategori }}</a>
            @endforeach
        </div>
        @auth
            <p class="mb-2 mt-7 px-3 text-[11px] font-semibold uppercase tracking-widest text-black">Panel Pengelolaan</p>
            <div class="space-y-1">
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('superadmin.dashboard') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.dashboard') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Dashboard Superadmin</a>
                    <a href="{{ route('superadmin.admins.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.admins.*') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Kelola Admin</a>
                    <a href="{{ route('admin.layanan.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.layanan.*') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Seluruh Layanan</a>
                    <a href="{{ route('admin.prodi.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.prodi.*') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Seluruh Portal Prodi</a>
                    <a href="{{ route('superadmin.groups.order') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.groups.*') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Urutan Grup</a>
                    <a href="{{ route('superadmin.footer-items.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.footer-items.*') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Kelola Footer</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.dashboard') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Dashboard Admin</a>
                    @if(auth()->user()->group?->kategori?->slug === 'portal-prodi')
                        <a href="{{ route('admin.prodi.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.prodi.*') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Kelola Portal Prodi</a>
                    @else
                        <a href="{{ route('admin.layanan.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.layanan.*') ? 'text-yellow-400 bg-white font-semibold' : 'hover:text-yellow-400 text-shadow-xs hover:bg-white' }}">Kelola Layanan</a>
                    @endif
                @endif
            </div>
        @endauth
    </nav>
    <div class="border-t border-white/10 p-4">
        @auth
            <div class="mb-3 flex items-center gap-3 px-2">
                <div class="size-11 shrink-0 overflow-hidden rounded-full bg-white/80">
                        <div class="flex size-full items-center justify-center text-sm font-bold text-yellow-600">
                            {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                        </div>
                </div>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold">
                        {{ auth()->user()->username }}
                    </p>
                    <p class="truncate text-xs text-black">
                        {{ auth()->user()->group?->nama_group ?? 'Superadmin' }}
                    </p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="w-full rounded-xl border border-white px-3 py-2 text-sm hover:text-yellow-300 text-shadow-xs hover:bg-white">Logout</button></form>
        @else
            <a href="{{ route('login') }}" class="block w-full rounded-xl bg-yellow-400 px-3 py-2.5 text-center text-sm font-bold text-blue-950 hover:bg-yellow-300">Masuk sebagai Admin</a>
        @endauth
    </div>
</aside>
