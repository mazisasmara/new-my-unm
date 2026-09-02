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
    <div class="fixed inset-0 -z-10 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(15, 23, 42, .58), rgba(15, 23, 42, .58)), url('{{ asset('storage/layanan-logo/BGunm.png') }}');"></div>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
