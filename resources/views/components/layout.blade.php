<!doctype html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $title ?? 'Arsip Digital UNM' }}
        · Universitas Negeri Makassar
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col text-slate-800 {{ request()->routeIs('admin.*', 'superadmin.*') ? '' : 'bg-[#F8FAFC]' }}">

    @php
        $isAdminArea = request()->routeIs('admin.*', 'superadmin.*');
    @endphp

    @if ($isAdminArea)
        <x-navbar />
    @else
        <x-public-navbar />
    @endif


    {{-- =====================================================
         CONTENT TETAP
    ====================================================== --}}
    <div class="flex flex-1 flex-col {{ $isAdminArea ? 'md:pl-72' : '' }}">

        <main class="flex-1">

            <div class="mx-auto max-w-7xl px-4 {{ $isAdminArea ? 'py-7' : '' }} sm:px-6 lg:px-8">

                {{ $slot }}

            </div>

        </main>

        @unless ($isAdminArea)
            <x-footer />
        @endunless

    </div>

    @if ($isAdminArea)
        <script>
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const sidebarToggle = document.getElementById('sidebar-toggle');

            function toggleSidebar(forceClose = false) {
                if (!sidebar || !backdrop) return;

                const opening = !forceClose && sidebar.classList.contains('-translate-x-full');
                sidebar.classList.toggle('-translate-x-full', !opening);
                backdrop.classList.toggle('hidden', !opening);
                sidebarToggle?.setAttribute('aria-expanded', opening ? 'true' : 'false');
            }

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') toggleSidebar(true);
            });
        </script>
    @endif
</body>

</html>
