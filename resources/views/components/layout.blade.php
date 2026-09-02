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

<body class="min-h-full text-slate-800">

    @php
        $isAdminArea = request()->routeIs('admin.*', 'superadmin.*');
    @endphp

    {{-- =====================================================
         BACKGROUND GEDUNG UNM
    ====================================================== --}}
    <div
        class="fixed inset-0 -z-10 bg-cover bg-center bg-no-repeat"
        style="
            background-image:
                linear-gradient(
                    rgba(255,255,255,0.35),
                    rgba(255,255,255,0.35)
                ),
                url('{{ asset('storage/layanan-logo/BGunm.png') }}');
        "
    ></div>


    @if ($isAdminArea)
        <x-navbar />
    @else
        <x-public-navbar />
    @endif


    {{-- =====================================================
         CONTENT TETAP
    ====================================================== --}}
    <div class="min-h-screen {{ $isAdminArea ? 'md:pl-72' : '' }}">

        <main class="min-h-[calc(100vh-13rem)]">

            <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 lg:px-8">

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

            function toggleSidebar(forceClose = false) {
                if (!sidebar || !backdrop) return;

                const opening = !forceClose && sidebar.classList.contains('-translate-x-full');
                sidebar.classList.toggle('-translate-x-full', !opening);
                backdrop.classList.toggle('hidden', !opening);
            }
        </script>
    @endif
</body>

</html>
