<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100">

<div class="min-h-screen grid lg:grid-cols-2">

  {{-- Kiri --}}
<div
    class="hidden lg:flex relative flex-col justify-between p-16 text-white bg-cover bg-center"
    style="background-image:url('{{ asset('images/mahasiswa-papua.png') }}');">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-950/90 via-blue-900/80 to-blue-700/70"></div>

    {{-- Content --}}
    <div class="relative z-10">

        <img
            src="{{ asset('images/logo.png') }}"
            class="w-20 mb-8">

        <h1 class="text-5xl font-bold leading-tight">

            SISTEM MONITORING

            <br>

            BANTUAN STUDI

            <br>

            AKHIR MAHASISWA

        </h1>

        <p class="mt-4 text-2xl font-semibold text-yellow-300">

            Kabupaten Mamberamo Tengah

        </p>

        <div class="w-20 h-1 mt-6 bg-yellow-400 rounded-full"></div>

        <p class="mt-8 max-w-lg text-lg leading-8 text-gray-100">

            Sistem Monitoring Bantuan Studi Akhir Mahasiswa
            Kabupaten Mamberamo Tengah untuk mengelola,
            memonitor, dan melaporkan penggunaan dana bantuan
            secara efektif, transparan, dan akuntabel.

        </p>

    </div>

    {{-- Footer --}}
    <div class="relative z-10">

        <div class="inline-flex items-center rounded-2xl bg-white/15 backdrop-blur-md px-6 py-4">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-10 h-10 mr-4 text-yellow-300"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0v6"/>

            </svg>

            <div>

                <p class="font-semibold">

                    Pendidikan adalah investasi terbaik

                </p>

                <p class="text-sm text-gray-200">

                    Untuk masa depan Papua yang lebih baik.

                </p>

            </div>

        </div>

    </div>

</div>

    {{-- Kanan --}}
    <div class="flex items-center justify-center bg-white">

        <div class="w-full max-w-md p-10">

            <h2 class="text-3xl font-bold">

                Selamat Datang

            </h2>

            <p class="text-gray-500 mt-2 mb-8">

                Silakan login untuk melanjutkan.

            </p>

            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">

                @csrf

                <div>

                    <x-input-label value="Email"/>

                    <x-text-input
                        name="email"
                        type="email"
                        class="w-full mt-1"
                        :value="old('email')"
                        required
                        autofocus/>

                    <x-input-error :messages="$errors->get('email')"/>

                </div>

                <div>

                    <x-input-label value="Password"/>

                    <x-text-input
                        name="password"
                        type="password"
                        class="w-full mt-1"
                        required/>

                    <x-input-error :messages="$errors->get('password')"/>

                </div>

                <label class="flex items-center text-sm">

                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300">

                    <span class="ml-2">

                        Ingat Saya

                    </span>

                </label>

                <button
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white rounded-lg py-3 font-semibold">

                    Masuk

                </button>

            </form>

        </div>

    </div>

</div>

</body>

</html>