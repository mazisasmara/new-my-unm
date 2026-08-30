<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · Arsip Digital UNM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-full items-center justify-center bg-slate-200 px-4 py-10">
    <main class="w-full max-w-sm">
        <div class="mb-5 text-center">
            <div class="mx-auto mb-3 flex size-16 items-center justify-center rounded-full bg-blue-900 text-xl font-black text-yellow-400 shadow-lg">UNM</div>
            <h1 class="text-2xl font-light text-slate-800"><strong class="font-bold">Arsip</strong> Digital</h1>
            <p class="mt-1 text-sm text-slate-500">Universitas Negeri Makassar</p>
        </div>

        <section class="overflow-hidden rounded-md border border-slate-300 bg-white shadow-lg">
            <div class="border-t-4 border-blue-600 px-6 py-7">
                <p class="mb-5 text-center text-sm text-slate-600">Masuk untuk memulai sesi pengelolaan</p>
                @if($errors->any())<div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
                <form method="POST" action="{{ url('/login') }}" class="space-y-4">@csrf
                    <div class="flex overflow-hidden rounded border border-slate-300 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500"><input type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" class="min-w-0 flex-1 border-0 px-3 py-2.5 text-sm outline-none" placeholder="Username"><span class="flex w-11 items-center justify-center border-l border-slate-300 bg-slate-50 text-slate-400"><svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" d="M20 21a8 8 0 0 0-16 0m12-13a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/></svg></span></div>
                    <div class="flex overflow-hidden rounded border border-slate-300 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500"><input type="password" name="password" required autocomplete="current-password" class="min-w-0 flex-1 border-0 px-3 py-2.5 text-sm outline-none" placeholder="Password"><span class="flex w-11 items-center justify-center border-l border-slate-300 bg-slate-50 text-slate-400"><svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" d="M7 10V7a5 5 0 0 1 10 0v3m-11 0h12v10H6V10Z"/></svg></span></div>
                    <div class="flex items-center justify-between"><label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600"> Ingat saya</label><button class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">Masuk</button></div>
                </form>
            </div>
            <a href="{{ route('home') }}" class="block border-t border-slate-200 bg-slate-50 px-6 py-3 text-center text-sm text-blue-700 hover:bg-slate-100">← Kembali ke halaman arsip</a>
        </section>
    </main>
</body>
</html>
