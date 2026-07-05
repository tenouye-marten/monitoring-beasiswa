<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    Monitoring Penggunaan Dana Beasiswa

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Monitoring penggunaan dana beasiswa mahasiswa.

                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ===================== --}}
            {{-- Pilih Tahun --}}
            {{-- ===================== --}}

            <div class="bg-white rounded-xl shadow border p-6">

                <form method="GET">

                    <div class="grid md:grid-cols-4 gap-4">

                        <div>

                            <x-input-label
                                for="tahun"
                                value="Tahun Beasiswa" />

                            <select
                                id="tahun"
                                name="tahun"
                                onchange="this.form.submit()"
                                class="mt-1 block w-full rounded-lg border-gray-300">

                                <option value="">

                                    -- Pilih Tahun --

                                </option>

                                @foreach($tahuns as $item)

                                    <option
                                        value="{{ $item }}"
                                        @selected($tahun==$item)>

                                        {{ $item }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </form>

            </div>

            @if(!$tahun)

                <div class="bg-white rounded-xl shadow border">

                    <div class="py-20 text-center">

                        <svg
                            class="mx-auto h-16 w-16 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z"/>

                        </svg>

                        <h3 class="mt-4 text-xl font-semibold">

                            Pilih Tahun Beasiswa

                        </h3>

                        <p class="mt-2 text-gray-500">

                            Silakan pilih tahun terlebih dahulu untuk melihat monitoring penggunaan dana.

                        </p>

                    </div>

                </div>

            @else

                {{-- ===================== --}}
                {{-- Card Statistik --}}
                {{-- ===================== --}}

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    <div class="bg-white rounded-xl shadow border p-6">

                        <p class="text-sm text-gray-500">

                            Total Penggunaan

                        </p>

                        <h2 class="mt-2 text-3xl font-bold text-indigo-600">

                            {{ $totalPenggunaan }}

                        </h2>

                    </div>

                    <div class="bg-white rounded-xl shadow border p-6">

                        <p class="text-sm text-gray-500">

                            Sudah Dimonitor

                        </p>

                        <h2 class="mt-2 text-3xl font-bold text-green-600">

                            {{ $sudahDimonitor }}

                        </h2>

                    </div>

                    <div class="bg-white rounded-xl shadow border p-6">

                        <p class="text-sm text-gray-500">

                            Belum Dimonitor

                        </p>

                        <h2 class="mt-2 text-3xl font-bold text-yellow-500">

                            {{ $belumDimonitor }}

                        </h2>

                    </div>

                    <div class="bg-white rounded-xl shadow border p-6">

                        <p class="text-sm text-gray-500">

                            Total Dana Digunakan

                        </p>

                        <h2 class="mt-2 text-2xl font-bold text-red-600">

                            Rp {{ number_format($totalNominal,0,',','.') }}

                        </h2>

                    </div>

                </div>

                {{-- ===================== --}}
                {{-- Filter --}}
                {{-- ===================== --}}

                <div class="bg-white rounded-xl shadow border p-6">

                    <form method="GET">

                        <input
                            type="hidden"
                            name="tahun"
                            value="{{ $tahun }}">

                        <div class="grid md:grid-cols-4 gap-4">

                            <div>

                                <x-input-label
                                    value="Cari Mahasiswa"/>

                                <x-text-input
                                    name="search"
                                    class="w-full mt-1"
                                    :value="request('search')"
                                    placeholder="Nama / NIM"/>

                            </div>

                            <div>

                                <x-input-label
                                    value="Kategori"/>

                                <select
                                    name="kategori"
                                    class="mt-1 block w-full rounded-lg border-gray-300">

                                    <option value="">

                                        Semua Kategori

                                    </option>

                                    @foreach($kategoriPenggunaans as $kategori)

                                        <option
                                            value="{{ $kategori->id }}"
                                            @selected(request('kategori')==$kategori->id)>

                                            {{ $kategori->nama }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="flex items-end">

                                <x-primary-button>

                                    Filter

                                </x-primary-button>

                            </div>

                        </div>

                    </form>

                </div>

                {{-- ===================== --}}
                {{-- Tabel --}}
                {{-- ===================== --}}

                <div class="bg-white rounded-xl shadow border overflow-hidden">

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-4 py-3 text-left">No</th>

                                    <th class="px-4 py-3 text-left">Mahasiswa</th>
                                    <th class="px-4 py-3 text-left">Judul</th>

                                    <th class="px-4 py-3 text-left">Kategori</th>

                                    <th class="px-4 py-3 text-right">Nominal</th>

                                    <th class="px-4 py-3 text-center">Tanggal</th>

                                    <th class="px-4 py-3 text-center">Monitoring</th>

                                    <th class="px-4 py-3 text-center">Aksi</th>

                                </tr>

                            </thead>

                            <tbody class="divide-y">

                                @forelse($penggunaans as $item)

                                    <tr>

                                        <td class="px-4 py-3">

                                            {{ $loop->iteration + ($penggunaans->firstItem()-1) }}

                                        </td>

                                        <td class="px-4 py-3">

                                            <div class="font-semibold">

                                                {{ $item->mahasiswa->nama }}

                                            </div>

                                            <div class="text-sm text-gray-500">

                                                {{ $item->mahasiswa->nim }}

                                            </div>

                                        </td>

                                        <td class="px-4 py-3">

                                            {{ $item->judul }}

                                        </td>
                                        <td class="px-4 py-3">

                                            {{ $item->kategori->nama }}

                                        </td>

                                        <td class="px-4 py-3 text-right">

                                            Rp {{ number_format($item->nominal,0,',','.') }}

                                        </td>

                                        <td class="px-4 py-3 text-center">

                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}

                                        </td>

                                        <td class="px-4 py-3 text-center">

                                            @if($item->tanggal_monitoring)

                                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">

                                                    Sudah

                                                </span>

                                            @else

                                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs">

                                                    Belum

                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-4 py-3">

                                            <div class="flex justify-center gap-2">

                                                <a
                                                    href="{{ route('monitoring.penggunaan-beasiswa.show',$item) }}"
                                                    class="px-3 py-2 bg-blue-600 rounded text-white text-sm">

                                                    Detail

                                                </a>

                                                <a
                                                    href="{{ route('monitoring.penggunaan-beasiswa.edit',$item) }}"
                                                    class="px-3 py-2 bg-indigo-600 rounded text-white text-sm">

                                                    Monitoring

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="7"
                                            class="text-center py-10 text-gray-500">

                                            Tidak ada data.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="border-t px-6 py-4">

                        {{ $penggunaans->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>