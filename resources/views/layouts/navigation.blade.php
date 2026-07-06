<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center">

                <div class="shrink-0">

                    @role('admin')
                        <a href="{{ route('admin.dashboard') }}">
                    @endrole

                    @role('keuangan')
                        <a href="{{ route('keuangan.dashboard') }}">
                    @endrole

                    @role('kepala')
                        <a href="{{ route('kepala.dashboard') }}">
                    @endrole

                    @role('mahasiswa')
                        <a href="{{ route('mahasiswa.dashboard') }}">
                    @endrole

                        <x-application-logo
                            class="block h-10 w-auto fill-current text-indigo-600"/>

                    </a>

                </div>

                {{-- Desktop Menu --}}

                <div class="hidden sm:flex sm:items-center sm:ms-8 space-x-2">

                                    @role('admin')

                        <x-nav-link
                            :href="route('admin.dashboard')"
                            :active="request()->routeIs('admin.dashboard')">

                            Dashboard

                        </x-nav-link>

                        <x-nav-link
                            :href="route('admin.mahasiswa.index')"
                            :active="request()->routeIs('admin.mahasiswa.*')">

                            Mahasiswa

                        </x-nav-link>

                        <x-nav-link
                            :href="route('admin.kategori-penggunaan.index')"
                            :active="request()->routeIs('admin.kategori-penggunaan.*')">

                            Kategori

                        </x-nav-link>

                      

             

                        <x-nav-link
                            :href="route('monitoring.penggunaan-beasiswa.index')"
                            :active="request()->routeIs('monitoring.*')">

                            Monitoring

                        </x-nav-link>

                        <x-nav-link
                            :href="route('laporan.index')"
                            :active="request()->routeIs('laporan.*')">

                            Laporan

                        </x-nav-link>

                    @endrole



                                        @role('keuangan')

                        <x-nav-link
                            :href="route('keuangan.dashboard')"
                            :active="request()->routeIs('keuangan.dashboard')">

                            Dashboard

                        </x-nav-link>

                        <x-nav-link
                            :href="route('monitoring.penggunaan-beasiswa.index')"
                            :active="request()->routeIs('monitoring.*')">

                            Monitoring

                        </x-nav-link>

                        <x-nav-link
                            :href="route('laporan.index')"
                            :active="request()->routeIs('laporan.*')">

                            Laporan

                        </x-nav-link>

                    @endrole


                                        @role('kepala')

                        <x-nav-link
                            :href="route('kepala.dashboard')"
                            :active="request()->routeIs('kepala.dashboard')">

                            Dashboard

                        </x-nav-link>

                        <x-nav-link
                            :href="route('laporan.index')"
                            :active="request()->routeIs('laporan.*')">

                            Laporan

                        </x-nav-link>

                    @endrole

                                        @role('mahasiswa')

                        <x-nav-link
                            :href="route('mahasiswa.dashboard')"
                            :active="request()->routeIs('mahasiswa.dashboard')">

                            Dashboard

                        </x-nav-link>

                        <x-nav-link
                            :href="route('mahasiswa.penggunaan-beasiswa.index')"
                            :active="request()->routeIs('mahasiswa.penggunaan-beasiswa.*')">

                            Penggunaan Dana

                        </x-nav-link>

                    @endrole

                </div>

            </div>

            <!-- Settings Dropdown -->

<div class="hidden sm:flex sm:items-center sm:ms-6">

    <x-dropdown align="right" width="56">

        <x-slot name="trigger">

            <button
                class="inline-flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition">

                <div class="text-right">

                    <div class="font-semibold text-gray-800">

                        {{ Auth::user()->name }}

                    </div>

                    <div class="text-xs text-gray-500">

                        {{ ucfirst(Auth::user()->roles->first()?->name ?? '-') }}

                    </div>

                </div>

                <svg
                    class="w-4 h-4 text-gray-500"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20">

                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"/>

                </svg>

            </button>

        </x-slot>

        <x-slot name="content">

            <div class="px-4 py-3 border-b">

                <p class="font-semibold">

                    {{ Auth::user()->name }}

                </p>

                <p class="text-sm text-gray-500">

                    {{ Auth::user()->email }}

                </p>

                <span
                    class="inline-block mt-2 px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded">

                    {{ strtoupper(Auth::user()->roles->first()?->name ?? '-') }}

                </span>

            </div>

            <x-dropdown-link
                :href="route('profile.edit')">

                👤 Profil Saya

            </x-dropdown-link>

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <x-dropdown-link
                    :href="route('logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">

                    🚪 Logout

                </x-dropdown-link>

            </form>

        </x-slot>

    </x-dropdown>

</div>

<!-- Hamburger -->

<div class="-me-2 flex items-center sm:hidden">

    <button
        @click="open = ! open"
        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100">

        <svg
            class="h-6 w-6"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24">

            <path
                :class="{ 'hidden': open, 'inline-flex': ! open }"
                class="inline-flex"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />

            <path
                :class="{ 'hidden': ! open, 'inline-flex': open }"
                class="hidden"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>

        </svg>

    </button>

</div>

<!-- Responsive Navigation Menu -->

<div :class="{ 'block': open, 'hidden': ! open }"
    class="hidden sm:hidden">

    <div class="pt-2 pb-3 space-y-1">

        {{-- ================= ADMIN ================= --}}

        @role('admin')

            <x-responsive-nav-link
                :href="route('admin.dashboard')"
                :active="request()->routeIs('admin.dashboard')">

                Dashboard

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('admin.mahasiswa.index')"
                :active="request()->routeIs('admin.mahasiswa.*')">

                Mahasiswa

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('admin.kategori-penggunaan.index')"
                :active="request()->routeIs('admin.kategori-penggunaan.*')">

                Kategori

            </x-responsive-nav-link>

    

            <x-responsive-nav-link
                :href="route('mahasiswa.penggunaan-beasiswa.index')"
                :active="request()->routeIs('mahasiswa.penggunaan-beasiswa.*')">

                Penggunaan Dana

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('monitoring.penggunaan-beasiswa.index')"
                :active="request()->routeIs('monitoring.*')">

                Monitoring

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('laporan.index')"
                :active="request()->routeIs('laporan.*')">

                Laporan

            </x-responsive-nav-link>

        @endrole


        {{-- ================= KEUANGAN ================= --}}

        @role('keuangan')

            <x-responsive-nav-link
                :href="route('keuangan.dashboard')"
                :active="request()->routeIs('keuangan.dashboard')">

                Dashboard

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('monitoring.penggunaan-beasiswa.index')"
                :active="request()->routeIs('monitoring.*')">

                Monitoring

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('laporan.index')"
                :active="request()->routeIs('laporan.*')">

                Laporan

            </x-responsive-nav-link>

        @endrole


        {{-- ================= KEPALA ================= --}}

        @role('kepala')

            <x-responsive-nav-link
                :href="route('kepala.dashboard')"
                :active="request()->routeIs('kepala.dashboard')">

                Dashboard

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('laporan.index')"
                :active="request()->routeIs('laporan.*')">

                Laporan

            </x-responsive-nav-link>

        @endrole


        {{-- ================= MAHASISWA ================= --}}

        @role('mahasiswa')

            <x-responsive-nav-link
                :href="route('mahasiswa.dashboard')"
                :active="request()->routeIs('mahasiswa.dashboard')">

                Dashboard

            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('mahasiswa.penggunaan-beasiswa.index')"
                :active="request()->routeIs('mahasiswa.penggunaan-beasiswa.*')">

                Penggunaan Dana

            </x-responsive-nav-link>

        @endrole

    </div>

        <!-- Responsive Settings Options -->

    <div class="pt-4 pb-2 border-t border-gray-200">

        <div class="px-4">

            <div class="font-semibold text-gray-800">

                {{ Auth::user()->name }}

            </div>

            <div class="text-sm text-gray-500">

                {{ Auth::user()->email }}

            </div>

            <div class="mt-2">

                <span class="inline-flex items-center px-2 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">

                    {{ strtoupper(Auth::user()->roles->first()?->name ?? '-') }}

                </span>

            </div>

        </div>

        <div class="mt-4 space-y-1">

            <x-responsive-nav-link
                :href="route('profile.edit')">

                Profil Saya

            </x-responsive-nav-link>

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">

                    Logout

                </x-responsive-nav-link>

            </form>

        </div>

    </div>

</div>

</nav>