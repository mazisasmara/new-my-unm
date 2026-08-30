<!doctype html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Arsip Digital UNM' }} · Universitas Negeri Makassar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 text-slate-800">
    <x-navbar />
    <div class="min-h-screen md:pl-72">
        <x-header>{{ $title ?? 'Arsip Digital UNM' }}</x-header>
        <main class="min-h-[calc(100vh-13rem)]">
            <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 lg:px-8">{{ $slot }}</div>
        </main>
        <x-footer />
    </div>
    <script>
        const sidebar = document.getElementById('app-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        function toggleSidebar(forceClose = false) {
            const opening = !forceClose && sidebar.classList.contains('-translate-x-full');
            sidebar.classList.toggle('-translate-x-full', !opening);
            backdrop.classList.toggle('hidden', !opening);
        }
    </script>
</body>
</html>
