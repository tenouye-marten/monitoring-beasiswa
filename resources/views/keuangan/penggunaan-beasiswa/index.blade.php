<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    {{ __('Monitoring Penggunaan Dana') }}

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Monitoring seluruh penggunaan dana beasiswa mahasiswa.

                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))

                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4">

                    <p class="text-green-700">

                        {{ session('success') }}

                    </p>

                </div>

            @endif

            {{-- Statistik --}}

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                <div class="bg-white rounded-lg shadow-sm border p-5">

                    <p class="text-sm text-gray-500">

                        Total Pengajuan

                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-indigo-600">

                        {{ $totalPengajuan }}

                    </h3>

                </div>

                <div class="bg-white rounded-lg shadow-sm border p-5">

                    <p class="text-sm text-gray-500">

                        Menunggu

                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-yellow-600">

                        {{ $menunggu }}

                    </h3>

                </div>

                <div class="bg-white rounded-lg shadow-sm border p-5">

                    <p class="text-sm text-gray-500">

                        Disetujui

                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-green-600">

                        {{ $disetujui }}

                    </h3>

                </div>

                <div class="bg-white rounded-lg shadow-sm border p-5">

                    <p class="text-sm text-gray-500">

                        Ditolak

                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-red-600">

                        {{ $ditolak }}

                    </h3>

                </div>

            </div>

            <div class="bg-white rounded-lg shadow-sm">

                <div class="p-6">
                    {{-- ====================================================== --}}
{{-- Search & Filter --}}
{{-- ====================================================== --}}

<form
    method="GET"
    action="{{ route('keuangan.penggunaan-beasiswa.index') }}"
    class="mb-6">

    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

        {{-- Search --}}
        <div>

            <x-input-label
                for="search"
                :value="__('Cari Mahasiswa')" />

            <x-text-input
                id="search"
                name="search"
                class="block mt-1 w-full"
                :value="request('search')"
                placeholder="Nama / NIM" />

        </div>

        {{-- Kategori --}}
        <div>

            <x-input-label
                for="kategori"
                :value="__('Kategori')" />

            <select
                id="kategori"
                name="kategori"
                class="mt-1 block w-full rounded-md border-gray-300">

                <option value="">

                    Semua Kategori

                </option>

                @foreach($kategoriPenggunaans as $kategori)

                    <option
                        value="{{ $kategori->id }}"
                        @selected(request('kategori') == $kategori->id)>

                        {{ $kategori->nama }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- Status --}}
        <div>

            <x-input-label
                for="status"
                :value="__('Status')" />

            <select
                id="status"
                name="status"
                class="mt-1 block w-full rounded-md border-gray-300">

                <option value="">

                    Semua Status

                </option>

                <option
                    value="Menunggu"
                    @selected(request('status') == 'Menunggu')>

                    Menunggu

                </option>

                <option
                    value="Disetujui"
                    @selected(request('status') == 'Disetujui')>

                    Disetujui

                </option>

                <option
                    value="Ditolak"
                    @selected(request('status') == 'Ditolak')>

                    Ditolak

                </option>

            </select>

        </div>

        {{-- Tahun --}}
        <div>

            <x-input-label
                for="tahun"
                :value="__('Tahun')" />

            <select
                id="tahun"
                name="tahun"
                class="mt-1 block w-full rounded-md border-gray-300">

                <option value="">

                    Semua Tahun

                </option>

                @foreach($tahuns as $tahun)

                    <option
                        value="{{ $tahun }}"
                        @selected(request('tahun') == $tahun)>

                        {{ $tahun }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- Tombol --}}
        <div class="flex items-end gap-2">

            <x-primary-button>

                Cari

            </x-primary-button>

            <a href="{{ route('keuangan.penggunaan-beasiswa.index') }}">

                <x-secondary-button type="button">

                    Reset

                </x-secondary-button>

            </a>

        </div>

    </div>

</form>
                </div>

                {{-- ====================================================== --}}
{{-- Tabel Monitoring --}}
{{-- ====================================================== --}}

<div class="overflow-x-auto">

    <table class="min-w-full divide-y divide-gray-200">

        <thead class="bg-gray-50">

            <tr>

                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                    No
                </th>

                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                    Mahasiswa
                </th>

                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                    Perguruan Tinggi
                </th>

                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                    Kategori
                </th>

                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                    Tanggal
                </th>

                <th class="px-4 py-3 text-right text-xs font-semibold uppercase">
                    Nominal
                </th>

                <th class="px-4 py-3 text-center text-xs font-semibold uppercase">
                    Status
                </th>

                <th class="px-4 py-3 text-center text-xs font-semibold uppercase">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200 bg-white">

            @forelse($penggunaans as $item)

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3">

                        {{ $penggunaans->firstItem() + $loop->index }}

                    </td>

                    <td class="px-4 py-3">

                        <div>

                            <div class="font-semibold text-gray-900">

                                {{ $item->mahasiswa->nama }}

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ $item->mahasiswa->nim }}

                            </div>

                        </div>

                    </td>

                    <td class="px-4 py-3">

                        {{ $item->mahasiswa->perguruan_tinggi }}

                    </td>

                    <td class="px-4 py-3">

                        {{ $item->kategori->nama }}

                    </td>

                    <td class="px-4 py-3">

                        {{ $item->tanggal->format('d M Y') }}

                    </td>

                    <td class="px-4 py-3 text-right font-medium">

                        Rp {{ number_format($item->nominal,0,',','.') }}

                    </td>

                    <td class="px-4 py-3 text-center">

                        @if($item->status=='Menunggu')

                            <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">

                                Menunggu

                            </span>

                        @elseif($item->status=='Disetujui')

                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                Disetujui

                            </span>

                        @else

                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                Ditolak

                            </span>

                        @endif

                    </td>

                    <td class="px-4 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('keuangan.penggunaan-beasiswa.show',$item) }}">

                                <x-secondary-button>

                                    Detail

                                </x-secondary-button>

                            </a>

                            @if($item->status=='Menunggu')

                                <a href="{{ route('keuangan.penggunaan-beasiswa.verifikasi',$item) }}">

                                    <x-primary-button>

                                        Verifikasi

                                    </x-primary-button>

                                </a>

                            @endif

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="py-12 text-center">

                        <div class="flex flex-col items-center">

                            <svg
                                class="w-16 h-16 text-gray-300"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M9 17v-2a4 4 0 014-4h6"/>

                            </svg>

                            <h3 class="mt-4 text-lg font-semibold text-gray-700">

                                Belum Ada Pengajuan

                            </h3>

                            <p class="mt-1 text-sm text-gray-500">

                                Belum terdapat penggunaan dana yang diajukan mahasiswa.

                            </p>

                        </div>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- ====================================================== --}}
{{-- Footer Table --}}
{{-- ====================================================== --}}

<div
    class="mt-6 flex flex-col gap-4 border-t border-gray-200 pt-4 md:flex-row md:items-center md:justify-between">

    <div class="text-sm text-gray-500">

        Menampilkan

        <strong>

            {{ $penggunaans->firstItem() ?? 0 }}

        </strong>

        -

        <strong>

            {{ $penggunaans->lastItem() ?? 0 }}

        </strong>

        dari

        <strong>

            {{ $penggunaans->total() }}

        </strong>

        data penggunaan dana.

    </div>

    <div>

        {{ $penggunaans->links() }}

    </div>

</div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>