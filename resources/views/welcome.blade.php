<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Monitoring Dana Bantuan Studi</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="h-screen w-full overflow-hidden flex flex-col lg:flex-row bg-white text-gray-900 font-sans">

    <!-- BAGIAN KIRI: Konten Informasi (Dominan Putih) -->
    <div class="flex-1 flex flex-col justify-between px-6 py-8 lg:px-16 lg:py-12 relative z-10">
        
        {{-- Navbar / Header --}}
        <header class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 md:w-12 md:h-12 object-contain">
            <div>
                <h1 class="text-sm md:text-base font-bold text-gray-900 tracking-wide">Monitoring Dana Bantuan</h1>
                <p class="text-xs font-medium text-blue-600">Kabupaten Mamberamo Tengah</p>
            </div>
        </header>

        {{-- Hero & Fitur --}}
        <main class="flex-1 flex flex-col justify-center max-w-xl">
            <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-1.5 text-xs font-bold text-blue-700 mb-6 w-fit border border-blue-100">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                Sistem Informasi Pemerintah
            </div>
            
            <h2 class="text-4xl lg:text-5xl font-black leading-tight tracking-tight text-black">
                Monitoring Bantuan <br>
                <span class="text-blue-600">Studi Akhir Mahasiswa</span>
            </h2>
            
            <p class="mt-4 text-sm lg:text-base text-gray-500 leading-relaxed">
                Sistem pengawasan penggunaan Dana Bantuan Studi Akhir secara transparan, efektif, dan akuntabel. Mempermudah proses pengawasan menjadi lebih cepat dan terdokumentasi.
            </p>

            {{-- Grid Fitur (Disembunyikan di HP agar tidak perlu scroll) --}}
            <div class="hidden md:grid grid-cols-2 gap-4 mt-10">
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-blue-200 hover:bg-blue-50/50">
                    <h3 class="font-bold text-gray-900 text-sm">Monitoring Dana</h3>
                    <p class="mt-1 text-xs text-gray-500">Pantau aliran dana bantuan mahasiswa.</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-blue-200 hover:bg-blue-50/50">
                    <h3 class="font-bold text-gray-900 text-sm">Data Terpusat</h3>
                    <p class="mt-1 text-xs text-gray-500">Manajemen data penerima bantuan.</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-blue-200 hover:bg-blue-50/50">
                    <h3 class="font-bold text-gray-900 text-sm">Validasi Keuangan</h3>
                    <p class="mt-1 text-xs text-gray-500">Cek silang penggunaan dana berkala.</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-blue-200 hover:bg-blue-50/50">
                    <h3 class="font-bold text-gray-900 text-sm">Laporan Otomatis</h3>
                    <p class="mt-1 text-xs text-gray-500">Ekspor format PDF & Excel instan.</p>
                </div>
            </div>
        </main>

        {{-- Footer Kiri --}}
        <footer class="text-xs text-gray-400 font-medium">
            © {{ date('Y') }} Pemkab Mamberamo Tengah • Dinas Pendidikan
        </footer>
    </div>

    <!-- BAGIAN KANAN: Login Form & Gambar -->
    <div class="w-full lg:w-[45%] h-full relative flex items-center justify-center p-6 lg:p-12 shrink-0">
        
        {{-- Background Gambar & Overlay Biru/Hitam --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/mahasiswa-papua.png') }}" alt="Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
        </div>

        {{-- Form Login Card --}}
        <div class="relative z-10 w-full max-w-sm bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-extrabold text-black">
                    Masuk ke Sistem
                </h2>
                <p class="mt-2 text-sm text-gray-500">
                    Gunakan kredensial Anda untuk login
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-1.5">Email Akses</label>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="nama@email.com" 
                        required
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-900 mb-1.5">Kata Sandi</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10">
                </div>

                <div class="flex items-center justify-between py-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                        <span class="text-xs text-gray-600 font-medium">Ingat Saya</span>
                    </label>
                </div>

                <button 
                    type="submit"
                    class="w-full rounded-xl bg-blue-600 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 active:scale-[0.98]">
                    Login Sekarang
                </button>
            </form>
        </div>
    </div>

</body>
</html>