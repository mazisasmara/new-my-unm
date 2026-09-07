<button type="button" onclick="toggleSidebar()" class="fixed left-4 top-4 z-40 rounded-xl bg-orange-700 p-2.5 text-white shadow-lg md:hidden" aria-label="Buka menu">
    <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
</button>
<div id="sidebar-backdrop" onclick="toggleSidebar(true)" class="fixed inset-0 z-40 hidden bg-slate-950/55 md:hidden"></div>
<aside id="app-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col bg-gradient-to-b from-orange-600 via-orange-700 to-orange-900 text-white shadow-2xl transition-transform duration-200 md:translate-x-0">
    <div class="flex h-20 items-center gap-3 border-b border-white/10 px-5">
        <img src="{{ asset('storage/layanan-logo/logo-unm.png') }}" alt="Logo Universitas Negeri Makassar" class="size-12 object-contain">
        <div><p class="font-bold leading-tight">Arsip Digital</p><p class="text-xs text-orange-100">Universitas Negeri Makassar</p></div>
        <button type="button" onclick="toggleSidebar(true)" class="ml-auto p-2 text-orange-100 md:hidden" aria-label="Tutup menu">✕</button>
    </div>
    <nav class="flex-1 overflow-y-auto px-4 py-5">
        <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-widest text-orange-100">Referensi Arsip</p>
        <div class="space-y-1">
            @foreach($kategoris as $item)
                @php
                    $href = $item->slug === 'universitas' ? route('home') : url($item->slug);
                    $active = $item->slug === 'universitas' ? request()->is('/') : request()->is($item->slug);
                @endphp
                <a href="{{ $href }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-yellow-400 text-orange-950 shadow' : 'text-orange-50 hover:bg-white/10' }}"><span class="flex size-7 items-center justify-center rounded-lg {{ $active ? 'bg-orange-950/10' : 'bg-white/10' }}">{{ $loop->iteration }}</span>{{ $item->nama_kategori }}</a>
            @endforeach
        </div>
        @auth
            <p class="mb-2 mt-7 px-3 text-[11px] font-semibold uppercase tracking-widest text-orange-100">Panel Pengelolaan</p>
            <div class="space-y-1">
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('superadmin.dashboard') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.dashboard') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Dashboard Superadmin</a>
                    <a href="{{ route('superadmin.admins.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.admins.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Kelola Admin</a>
                    <a href="{{ route('admin.layanan.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.layanan.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Seluruh Layanan</a>
                    <a href="{{ route('admin.prodi.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.prodi.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Seluruh Portal Prodi</a>
                    <a href="{{ route('superadmin.groups.order') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.groups.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Urutan Grup</a>
                    <a href="{{ route('superadmin.footer-items.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.footer-items.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Kelola Footer</a>
                    <a href="{{ route('superadmin.settings.edit') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('superadmin.settings.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Pengaturan</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Dashboard Admin</a>
                    @if(auth()->user()->group?->kategori?->slug === 'portal-prodi')
                        <a href="{{ route('admin.prodi.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.prodi.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Kelola Portal Prodi</a>
                    @else
                        <a href="{{ route('admin.layanan.index') }}" class="block rounded-xl px-3 py-2.5 text-sm {{ request()->routeIs('admin.layanan.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">Kelola Layanan</a>
                    @endif
                @endif
            </div>
        @endauth
    </nav>
    <div class="border-t border-white/10 p-4">
        @auth
            <div class="mb-3 px-2"><p class="truncate text-sm font-semibold">{{ auth()->user()->username }}</p><p class="truncate text-xs text-orange-100">{{ auth()->user()->group?->nama_group ?? 'Superadmin' }}</p></div>
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="w-full rounded-xl border border-white/15 px-3 py-2 text-sm hover:bg-white/10">Keluar</button></form>
        @else
            <a href="{{ route('login') }}" class="block w-full rounded-xl bg-yellow-400 px-3 py-2.5 text-center text-sm font-bold text-orange-950 hover:bg-yellow-300">Masuk sebagai Admin</a>
        @endauth
    </div>
</aside>
