@props(['title' => 'Detail Layanan'])

<!doctype html>
<html lang="id" class="min-h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} · Universitas Negeri Makassar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col text-slate-800">
    <div class="fixed inset-0 -z-10 overflow-hidden">
    <div
        class="absolute inset-0 scale-105 bg-cover bg-center bg-no-repeat blur-sm"
        style="background-image: url('{{ asset('storage/layanan-logo/BGunm.png') }}');">
    </div>

    <div class="absolute inset-0 bg-slate-900/55"></div>
</div>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-footer />
</body>

</html>
