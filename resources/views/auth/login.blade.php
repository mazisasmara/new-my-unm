<!doctype html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login · Arsip Digital UNM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-200">

    <div class="min-h-screen flex flex-col lg:flex-row">


        {{-- =====================================================
             PANEL KIRI
        ====================================================== --}}
        <div class="relative w-full lg:w-1/2 min-h-screen
                    bg-gradient-to-b from-yellow-500
                    via-orange-500
                    to-orange-700">

            {{-- =================================================
                 LOGO MYUNM
            ================================================== --}}
            <div class="absolute top-7 left-7
                        lg:top-8 lg:left-7">

                <div class="flex items-center gap-4">

                    <img
                        src="{{ asset('storage/layanan-logo/logo-unm.png') }}"
                        alt="Logo MyUNM"
                        class="w-20 h-20 object-contain"
                    >

                    <div>

                        <h2 class="text-2xl font-medium text-black">
                            MyUNM
                        </h2>

                        <p class="text-sm font-medium text-blue-700">
                            Admin Super
                        </p>

                    </div>

                </div>

                {{-- Garis --}}
                <div class="mt-5 h-[2px] w-56 bg-white"></div>

            </div>


            {{-- =================================================
                 KONTEN UTAMA KIRI
            ================================================== --}}
            <div class="absolute
                        top-1/2
                        left-1/2
                        -translate-x-1/2
                        -translate-y-1/2
                        w-[82%]
                        max-w-xl">

                {{-- Logo UNM --}}
                <div class="flex justify-center">

                    <img
                        src="{{ asset('storage/layanan-logo/logo-myunm.png') }}"
                        alt="Universitas Negeri Makassar"
                        class="w-[380px] max-w-full h-auto object-contain"
                    >

                </div>


                {{-- Garis bawah logo --}}
                <div class="mt-3 h-[2px] w-full bg-white"></div>


                {{-- Selamat datang --}}
                <h1 class="mt-4
                           text-5xl
                           font-normal
                           leading-tight
                           text-black">

                    Selamat datang<br>
                    kembali!

                </h1>


                {{-- Deskripsi --}}
                <div class="mt-3 flex items-start gap-2">

                    <span class="text-2xl leading-none text-red-500">
                        •
                    </span>

                    <p class="text-xl leading-tight text-white">

                        Silahkan login untuk mengakses<br>
                        dashboard my.unm.ac.id

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             PANEL KANAN
        ====================================================== --}}
        <div class="w-full lg:w-1/2 min-h-screen
                    flex items-center justify-center
                    bg-gray-200
                    px-6 py-10">

            <section class="w-full max-w-xl
                            rounded-2xl
                            bg-gradient-to-b
                            from-yellow-700
                            via-orange-600
                            to-orange-500
                            px-8
                            py-12
                            lg:px-16
                            lg:py-16">

                {{-- =================================================
                     ICON LOCK
                ================================================== --}}
                <div class="flex justify-center mb-12">

                    <div class="flex items-center justify-center
                                w-20 h-20
                                rounded-full
                                border-2 border-blue-300
                                bg-blue-100
                                shadow-md">

                        <svg
                            class="w-12 h-12 text-blue-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7 10V7a5 5 0 0 1 10 0v3
                                   M6 10h12v10H6V10Z
                                   M12 14v2" />

                        </svg>

                    </div>

                </div>


                {{-- =================================================
                     INFO ADMIN SUPER
                ================================================== --}}
                <div class="mb-11
                            rounded-md
                            bg-gray-200
                            px-5
                            py-4
                            text-black">

                    <div class="flex items-start gap-3">

                        <span class="text-xl">
                            •
                        </span>

                        <div>

                            <h3 class="text-xl font-normal">
                                Admin super
                            </h3>

                            <p class="mt-3
                                      text-base
                                      leading-tight">

                                Akun dengan akses penuh untuk mengelola
                                sistem, pengguna, dan semua fitur

                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ERROR LOGIN
                ================================================== --}}
                @if($errors->any())

                    <div class="mb-5
                                rounded-md
                                border border-red-300
                                bg-red-100
                                px-4 py-3
                                text-sm
                                text-red-700">

                        {{ $errors->first() }}

                    </div>

                @endif


                {{-- =================================================
                     FORM LOGIN
                ================================================== --}}
                <form
                    method="POST"
                    action="{{ url('/login') }}"
                    class="space-y-4">

                    @csrf


                    {{-- USERNAME --}}
                    <div>

                        <label
                            for="username"
                            class="mb-1 block text-base text-black">

                            Username

                        </label>

                        <input
                            id="username"
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            required
                            autofocus
                            autocomplete="username"

                            class="h-12
                                   w-full
                                   rounded-xl
                                   border-0
                                   bg-gray-200
                                   px-4
                                   text-black
                                   outline-none
                                   focus:ring-2
                                   focus:ring-yellow-400">

                    </div>


                    {{-- PASSWORD --}}
                    <div>

                        <label
                            for="password"
                            class="mb-1 block text-base text-black">

                            Password

                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"

                            class="h-12
                                   w-full
                                   rounded-xl
                                   border-0
                                   bg-gray-200
                                   px-4
                                   text-black
                                   outline-none
                                   focus:ring-2
                                   focus:ring-yellow-400">

                    </div>


                    {{-- =================================================
                         REMEMBER
                    ================================================== --}}
                    <div class="flex items-center pt-1">

                        <label class="flex items-center gap-2
                                      text-sm
                                      text-black">

                            <input
                                type="checkbox"
                                name="remember"

                                class="h-5 w-5
                                       rounded-none
                                       border-0
                                       bg-gray-200
                                       text-yellow-500
                                       focus:ring-yellow-400">

                            <span>
                                ingat saya
                            </span>

                        </label>
                    </div>


                    {{-- =================================================
                         TOMBOL LOGIN
                    ================================================== --}}
                    <div class="flex justify-center pt-1">

                        <button
                            type="submit"

                            class="h-10
                                   w-48
                                   rounded-xl
                                   bg-yellow-400
                                   text-lg
                                   font-normal
                                   text-black
                                   shadow-sm
                                   transition
                                   duration-200
                                   hover:bg-yellow-300
                                   active:bg-yellow-500">

                            login

                        </button>

                    </div>

                </form>


                {{-- =================================================
                     SUPPORT
                ================================================== --}}
                <div class="mt-20">

                    <div class="mb-5 h-[2px] bg-white"></div>

                    <div class="flex
                                items-center
                                justify-center
                                gap-2
                                text-lg
                                text-white">

                        {{-- Icon --}}
                        <svg
                            class="h-6 w-6 text-black"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke-width="1.8" />

                            <path
                                stroke-width="1.8"
                                stroke-linecap="round"
                                d="M8 13a4 4 0 0 0 8 0
                                   M9 10h.01
                                   M15 10h.01" />

                        </svg>


                        <span>
                            Butuh bantuan?
                        </span>


                        @if($customerServiceEmail)
                        <a
                            href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to={{ urlencode($customerServiceEmail) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-blue-700
                                   hover:text-blue-900
                                   hover:underline">

                            Hubungi Tim Support

                        </a>
                        @else
                            <span class="text-gray-100">Hubungi Tim Support</span>
                        @endif

                    </div>

                </div>

            </section>

        </div>

    </div>

</body>

</html>
