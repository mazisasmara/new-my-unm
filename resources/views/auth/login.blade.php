<!doctype html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login · Arsip Digital UNM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-canvas text-ink">
    <main class="grid min-h-screen lg:grid-cols-2">
        <section class="relative overflow-hidden bg-brand px-6 py-8 text-white sm:px-10 lg:flex lg:min-h-screen lg:flex-col lg:justify-between lg:px-14 lg:py-12">
            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/layanan-logo/logo-unm.png') }}" alt="Logo Universitas Negeri Makassar" class="size-14 object-contain sm:size-16">
                <div>
                    <p class="text-xl font-bold text-white">MyUNM</p>
                    <p class="text-sm font-medium text-white/85">Portal administrasi</p>
                </div>
            </div>

            <div class="relative z-10 mt-12 max-w-xl lg:my-auto lg:py-16">
                <img src="{{ asset('storage/layanan-logo/logo-myunm.png') }}" alt="MyUNM" class="h-auto w-64 max-w-full object-contain brightness-0 invert sm:w-80">
                <div class="mt-6 h-1 w-16 rounded-full bg-action"></div>
                <h1 class="mt-6 text-4xl font-bold leading-tight text-white sm:text-5xl">Selamat datang kembali!</h1>
                <p class="mt-4 max-w-md text-base leading-7 text-white/90 sm:text-lg">Masuk untuk mengelola layanan dan informasi di dashboard MyUNM.</p>
            </div>

            <p class="mt-10 hidden text-sm text-white/80 lg:block">Universitas Negeri Makassar</p>
            <div class="pointer-events-none absolute -bottom-24 -right-20 size-72 rounded-full bg-action/20"></div>
        </section>

        <section class="flex items-center justify-center px-5 py-10 sm:px-10 lg:px-16">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <p class="font-semibold text-brand">Area pengelola</p>
                    <h2 class="mt-2 text-3xl font-bold text-slate-950">Masuk ke akun Anda</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Gunakan username dan password admin yang telah terdaftar.</p>
                </div>

                @if($errors->any())
                    <div role="alert" class="mb-5 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ url('/login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="username" class="mb-2 block text-sm font-semibold text-slate-900">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" class="app-input" placeholder="Masukkan username">
                    </div>
                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-900">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="app-input" placeholder="Masukkan password">
                    </div>
                    <button type="submit" class="app-button-primary mt-2 w-full">Masuk</button>
                </form>

                <div class="mt-8 border-t border-slate-200 pt-6 text-center text-sm text-slate-600">
                    <span>Butuh bantuan?</span>
                    <a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to={{ urlencode($customerServiceEmail) }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-brand underline-offset-4 hover:underline">Hubungi Tim Support</a>
                </div>
            </div>
        </section>
    </main>

</body>

</html>
