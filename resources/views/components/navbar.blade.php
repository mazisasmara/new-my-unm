<button type="button" onclick="toggleSidebar()" class="fixed left-4 top-4 z-40 rounded-xl bg-brand p-2.5 text-white shadow-lg md:hidden" aria-label="Buka menu" aria-controls="app-sidebar" aria-expanded="false" id="sidebar-toggle">
    <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
</button>
<div id="sidebar-backdrop" onclick="toggleSidebar(true)" class="fixed inset-0 z-40 hidden bg-slate-950/55 md:hidden"></div>
<aside id="app-sidebar" class="app-sidebar fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col shadow-2xl transition-transform duration-200 md:translate-x-0">
    <div class="flex h-20 items-center gap-3 border-b border-white/10 px-5">
        <img
        src="{{ asset('storage/layanan-logo/logo-put.png') }}" 
        alt="MyUNM"
        class="w-52 object-contain"></img>
        <button type="button" onclick="toggleSidebar(true)" class="ml-auto rounded-lg p-2 text-white hover:bg-white/15 md:hidden" aria-label="Tutup menu">✕</button>
    </div>
    <nav class="flex-1 overflow-y-auto px-4 py-5">
        <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-widest text-white/75">Referensi Arsip</p>
        <div class="space-y-1">
            @foreach($kategoris as $item)
                @php
                    $href = $item->slug === 'universitas' ? route('home') : url($item->slug);
                    $active = $item->slug === 'universitas' ? request()->is('/') : request()->is($item->slug);
                @endphp
                <a href="{{ $href }}" class="app-sidebar-link {{ $active ? 'app-sidebar-link-active' : '' }}">{{ $item->nama_kategori }}</a>
            @endforeach
        </div>
        @auth
            <p class="mb-2 mt-7 px-3 text-[11px] font-semibold uppercase tracking-widest text-white/75">Panel Pengelolaan</p>
            <div class="space-y-1">
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('superadmin.dashboard') }}" class="app-sidebar-link {{ request()->routeIs('superadmin.dashboard') ? 'app-sidebar-link-active' : '' }}">Dashboard Superadmin</a>
                    <a href="{{ route('superadmin.admins.index') }}" class="app-sidebar-link {{ request()->routeIs('superadmin.admins.*') ? 'app-sidebar-link-active' : '' }}">Kelola Admin</a>
                    <a href="{{ route('admin.layanan.index') }}" class="app-sidebar-link {{ request()->routeIs('admin.layanan.*') ? 'app-sidebar-link-active' : '' }}">Seluruh Layanan</a>
                    <a href="{{ route('admin.prodi.index') }}" class="app-sidebar-link {{ request()->routeIs('admin.prodi.*') ? 'app-sidebar-link-active' : '' }}">Seluruh Portal Prodi</a>
                    <a href="{{ route('superadmin.groups.order') }}" class="app-sidebar-link {{ request()->routeIs('superadmin.groups.*') ? 'app-sidebar-link-active' : '' }}">Urutan Grup</a>
                    <a href="{{ route('superadmin.footer-items.index') }}" class="app-sidebar-link {{ request()->routeIs('superadmin.footer-items.*') ? 'app-sidebar-link-active' : '' }}">Kelola Footer</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="app-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'app-sidebar-link-active' : '' }}">Dashboard Admin</a>
                    @if(auth()->user()->group?->kategori?->slug === 'portal-prodi')
                        <a href="{{ route('admin.prodi.index') }}" class="app-sidebar-link {{ request()->routeIs('admin.prodi.*') ? 'app-sidebar-link-active' : '' }}">Kelola Portal Prodi</a>
                    @else
                        <a href="{{ route('admin.layanan.index') }}" class="app-sidebar-link {{ request()->routeIs('admin.layanan.*') ? 'app-sidebar-link-active' : '' }}">Kelola Layanan</a>
                    @endif
                @endif
            </div>
        @endauth
    </nav>
    <div class="border-t border-white/10 p-4">
        @auth
            <div class="mb-3 flex items-center gap-3 px-2">
                <div class="size-11 shrink-0 overflow-hidden rounded-full bg-white/80">
                        <div class="flex size-full items-center justify-center text-sm font-bold text-brand">
                            {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                        </div>
                </div>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold">
                        {{ auth()->user()->username }}
                    </p>
                    <p class="truncate text-xs text-white/80">
                        {{ auth()->user()->group?->nama_group ?? 'Superadmin' }}
                    </p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="w-full rounded-xl border border-white px-3 py-2 text-sm font-semibold text-white transition hover:bg-white hover:text-ink">Logout</button></form>
        @else
            <a href="{{ route('login') }}" class="app-button-primary w-full text-sm">Masuk sebagai Admin</a>
        @endauth
    </div>
</aside>
