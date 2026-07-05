<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    Dashboard Keuangan

                </h2>

                <p class="text-sm text-gray-500">

                    Ringkasan penggunaan Dana Bantuan Studi.

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
                            @selected($tahun==$item)>

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
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-white rounded-xl border shadow-sm p-5">

                    <p class="text-sm text-gray-500">

                        Total Mahasiswa

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-indigo-600">

                        {{ number_format($totalMahasiswa) }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl border shadow-sm p-5">

                    <p class="text-sm text-gray-500">

                        Dana Beasiswa

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-green-600">

                        Rp {{ number_format($totalDana,0,',','.') }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl border shadow-sm p-5">

                    <p class="text-sm text-gray-500">

                        Dana Digunakan

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-yellow-500">

                        Rp {{ number_format($totalDigunakan,0,',','.') }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl border shadow-sm p-5">

                    <p class="text-sm text-gray-500">

                        Sisa Dana

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-red-600">

                        Rp {{ number_format($sisaDana,0,',','.') }}

                    </h2>

                </div>

            </div>

            {{-- Chart --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white rounded-xl border shadow-sm">

                    <div class="border-b px-6 py-4">

                        <h3 class="font-semibold">

                            Penggunaan Dana per Kategori

                        </h3>

                    </div>

                    <div class="p-6 h-80">

                        <canvas id="kategoriChart"></canvas>

                    </div>

                </div>

                <div class="bg-white rounded-xl border shadow-sm">

                    <div class="border-b px-6 py-4">

                        <h3 class="font-semibold">

                            Penggunaan Dana per Bulan

                        </h3>

                    </div>

                    <div class="p-6 h-80">

                        <canvas id="bulananChart"></canvas>

                    </div>

                </div>

            </div>

            {{-- Tabel --}}
            <div class="bg-white rounded-xl border shadow-sm">

                <div class="flex items-center justify-between border-b px-6 py-4">

                    <h3 class="font-semibold">

                        Transaksi Penggunaan Dana Terbaru

                    </h3>

                    <a
                        href="{{ route('keuangan.penggunaan-beasiswa.index') }}"
                        class="text-sm text-indigo-600 hover:underline">

                        Lihat Semua

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-5 py-3 text-left">Tanggal</th>

                                <th class="px-5 py-3 text-left">Mahasiswa</th>

                                <th class="px-5 py-3 text-left">Judul</th>

                                <th class="px-5 py-3 text-left">Kategori</th>

                                <th class="px-5 py-3 text-right">Nominal</th>

                                <th class="px-5 py-3 text-center">Aksi</th>

                            </tr>

                        </thead>

                        <tbody class="divide-y">

                            @forelse($penggunaanTerbaru as $item)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-5 py-4">

                                        {{ $item->tanggal->format('d/m/Y') }}

                                    </td>

                                    <td class="px-5 py-4">

                                        {{ $item->mahasiswa->nama }}

                                    </td>

                                    <td class="px-5 py-4">

                                        {{ $item->judul }}

                                    </td>

                                    <td class="px-5 py-4">

                                        {{ $item->kategori->nama }}

                                    </td>

                                    <td class="px-5 py-4 text-right font-semibold text-green-600">

                                        Rp {{ number_format($item->nominal,0,',','.') }}

                                    </td>

                                    <td class="px-5 py-4 text-center">

                                        <a
                                            href="{{ route('keuangan.penggunaan-beasiswa.show',$item) }}"
                                            class="px-3 py-2 rounded-lg bg-indigo-600 text-white text-xs hover:bg-indigo-700">

                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="py-8 text-center text-gray-500">

                                        Belum ada data.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')

    <script>

        document.addEventListener('DOMContentLoaded',()=>{

            renderDashboardCharts({

                kategori:{

                    labels:@json($kategoriChart->pluck('nama')),

                    values:@json($kategoriChart->pluck('total'))

                },

                monitoring:[0,0],

                bulanan:{

                    labels:@json($bulananChart->pluck('bulan')),

                    values:@json($bulananChart->pluck('total'))

                }

            });

        });

    </script>

    @endpush

</x-app-layout>