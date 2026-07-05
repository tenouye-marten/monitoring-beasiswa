<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    Dashboard Kepala

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Sistem Monitoring Penggunaan Dana Beasiswa

                </p>

            </div>

            <form method="GET">

                <select
                    name="tahun"
                    onchange="this.form.submit()"
                    class="rounded-lg border-gray-300">

                    @foreach($tahuns as $item)

                        <option
                            value="{{ $item }}"
                            @selected($tahun == $item)>

                            {{ $item }}

                        </option>

                    @endforeach

                </select>

            </form>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Statistik --}}

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                <div class="bg-white rounded-xl shadow border p-6">

                    <p class="text-sm text-gray-500">

                        Total Mahasiswa

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-indigo-600">

                        {{ number_format($totalMahasiswa) }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl shadow border p-6">

                    <p class="text-sm text-gray-500">

                        Total Dana Beasiswa

                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-green-600">

                        Rp {{ number_format($totalDana,0,',','.') }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl shadow border p-6">

                    <p class="text-sm text-gray-500">

                        Dana Digunakan

                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-yellow-600">

                        Rp {{ number_format($totalDigunakan,0,',','.') }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl shadow border p-6">

                    <p class="text-sm text-gray-500">

                        Sisa Dana

                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-red-600">

                        Rp {{ number_format($sisaDana,0,',','.') }}

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

                    <h2 class="mt-2 text-3xl font-bold text-orange-500">

                        {{ $belumDimonitor }}

                    </h2>

                </div>

            </div>

            {{-- Penggunaan Dana Terbaru --}}

            <div class="bg-white rounded-xl shadow border overflow-hidden">

                <div class="px-6 py-4 border-b">

                    <h3 class="font-semibold text-lg">

                        Penggunaan Dana Terbaru

                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-4 py-3 text-left">

                                    Mahasiswa

                                </th>

                                <th class="px-4 py-3 text-left">

                                    Kategori

                                </th>

                                <th class="px-4 py-3 text-right">

                                    Nominal

                                </th>

                                <th class="px-4 py-3 text-center">

                                    Monitoring

                                </th>

                                <th class="px-4 py-3 text-center">

                                    Petugas

                                </th>

                                <th class="px-4 py-3 text-center">

                                    Aksi

                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse($penggunaanTerbaru as $item)

                                <tr>

                                    <td class="px-4 py-3">

                                        <div class="font-semibold">

                                            {{ $item->mahasiswa->nama }}

                                        </div>

                                        <div class="text-xs text-gray-500">

                                            {{ $item->mahasiswa->nim }}

                                        </div>

                                    </td>

                                    <td class="px-4 py-3">

                                        {{ $item->kategori->nama }}

                                    </td>

                                    <td class="px-4 py-3 text-right">

                                        Rp {{ number_format($item->nominal,0,',','.') }}

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

                                    <td class="px-4 py-3 text-center">

                                        {{ optional($item->petugas)->name ?? '-' }}

                                    </td>

                                    <td class="px-4 py-3 text-center">

                                        <a
                                            href="{{ route('monitoring.penggunaan-beasiswa.show', $item) }}"
                                            class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700">

                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-4 py-10 text-center text-gray-500">

                                        Belum ada data penggunaan dana.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>