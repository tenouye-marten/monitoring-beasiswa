<div 
    x-show="open" 
    style="display: none;"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
    
    <!-- Latar Belakang Gelap (Backdrop Blur) -->
    <div 
        x-show="open" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm">
    </div>

    <!-- Kotak Modal -->
    <div 
        x-show="open" 
        @click.outside="open = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative w-full max-w-md transform overflow-hidden rounded-3xl bg-white p-8 text-left shadow-2xl ring-1 ring-gray-900/5 transition-all">
        
        <!-- Tombol Tutup (X) -->
        <button 
            @click="open = false" 
            class="absolute right-5 top-5 rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Header Modal -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-extrabold text-gray-900">
                Selamat Datang
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Silakan masuk untuk mengakses sistem monitoring.
            </p>
        </div>

        <!-- Form Login -->
        <form 
            method="POST" 
            action="{{ route('login') }}" 
            class="space-y-5">
            
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="nama@email.com" 
                    required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="••••••••" 
                    required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            </div>

            <div class="pt-2">
                <button 
                    type="submit"
                    class="w-full rounded-xl bg-blue-600 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/30 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 active:scale-[0.98]">
                    Masuk Sekarang
                </button>
            </div>
            
        </form>

    </div>
</div>