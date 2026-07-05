<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold">
                    Laporan Penggunaan Dana Beasiswa
                </h2>

                <p class="text-sm text-gray-500">
                    Rekapitulasi penggunaan dana beasiswa mahasiswa.
                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6 space-y-6">

            {{-- Filter --}}

            <form method="GET" class="bg-white rounded-xl shadow p-5">

                <div class="grid md:grid-cols-5 gap-4">

                    <select name="tahun" class="rounded-lg border-gray-300">

                        @foreach($tahuns as $item)

                            <option
                                value="{{ $item }}"
                                @selected($tahun==$item)>

                                {{ $item }}

                            </option>

                        @endforeach

                    </select>

                    <select name="perguruan_tinggi" class="rounded-lg border-gray-300">

                        <option value="">Semua Perguruan Tinggi</option>

                        @foreach($perguruanTinggis as $item)

                            <option
                                value="{{ $item }}"
                                @selected($perguruanTinggi==$item)>

                                {{ $item }}

                            </option>

                        @endforeach

                    </select>

                    <select name="jenis_beasiswa" class="rounded-lg border-gray-300">

                        <option value="">Semua Beasiswa</option>

                        @foreach($jenisBeasiswas as $item)

                            <option
                                value="{{ $item }}"
                                @selected($jenisBeasiswa==$item)>

                                {{ $item }}

                            </option>

                        @endforeach

                    </select>

                    <select name="kategori" class="rounded-lg border-gray-300">

                        <option value="">Semua Kategori</option>

                        @foreach($kategoriPenggunaans as $item)

                            <option
                                value="{{ $item->id }}"
                                @selected($kategori==$item->id)>

                                {{ $item->nama }}

                            </option>

                        @endforeach

                    </select>

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Nama / NIM"
                        class="rounded-lg border-gray-300">

                </div>

                <div class="mt-4 flex gap-3">

                    <x-primary-button>

                        Filter

                    </x-primary-button>

                    <a
                        href="{{ route('laporan.index') }}"
                        class="px-4 py-2 bg-gray-500 rounded-lg text-white">

                        Reset

                    </a>

                    <a
                        href="{{ route('laporan.excel', request()->query()) }}"
                        class="px-4 py-2 bg-green-600 rounded-lg text-white">

                        Excel

                    </a>

                  <a
    href="{{ route('laporan.pdf', request()->query()) }}"
    target="_blank"
    class="px-4 py-2 bg-red-600 rounded-lg text-white hover:bg-red-700">

    PDF

</a>

                </div>

            </form>

            {{-- Statistik --}}

            <div class="grid md:grid-cols-2 gap-5">

                <div class="bg-white rounded-xl shadow p-5">

                    <p class="text-sm text-gray-500">

                        Total Penggunaan

                    </p>

                    <h2 class="text-3xl font-bold text-indigo-600 mt-2">

                        {{ number_format($totalPenggunaan) }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl shadow p-5">

                    <p class="text-sm text-gray-500">

                        Total Nominal

                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">

                        Rp {{ number_format($totalNominal,0,',','.') }}

                    </h2>

                </div>

            </div>

            {{-- Table --}}

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <table class="w-full text-sm">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="p-3">No</th>
                            <th class="p-3 text-left">Mahasiswa</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3 text-right">Nominal</th>
                            <th class="p-3">Monitoring</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($laporans as $item)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-3">

                                    {{ $loop->iteration + $laporans->firstItem() - 1 }}

                                </td>

                                <td class="p-3">

                                    <div class="font-semibold">

                                        {{ $item->mahasiswa->nama }}

                                    </div>

                                    <div class="text-xs text-gray-500">

                                        {{ $item->mahasiswa->nim }}

                                    </div>

                                </td>

                                <td class="p-3">

                                    {{ $item->kategori->nama }}

                                </td>

                                <td class="p-3 text-center">

                                    {{ $item->tanggal->format('d-m-Y') }}

                                </td>

                                <td class="p-3 text-right">

                                    Rp {{ number_format($item->nominal,0,',','.') }}

                                </td>

                                <td class="p-3 text-center">

                                    @if($item->tanggal_monitoring)

                                        <span class="text-green-600">

                                            Sudah

                                        </span>

                                    @else

                                        <span class="text-orange-500">

                                            Belum

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="py-8 text-center text-gray-500">

                                    Tidak ada data.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="border-t p-4">

                    {{ $laporans->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>