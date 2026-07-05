<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold text-gray-900">

                Dashboard Mahasiswa

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Selamat datang, {{ $mahasiswa->nama }}

            </p>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

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

                    <h2 class="mt-2 text-3xl font-bold text-indigo-600">

                        Rp {{ number_format($sisaDana,0,',','.') }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl border shadow-sm p-5">

                    <p class="text-sm text-gray-500">

                        Total Penggunaan

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-red-600">

                        {{ $totalPenggunaan }}

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

            {{-- Riwayat --}}
            <div class="bg-white rounded-xl border shadow-sm">

                <div class="border-b px-6 py-4">

                    <h3 class="font-semibold">

                        Riwayat Penggunaan Dana

                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-5 py-3 text-left">Tanggal</th>

                                <th class="px-5 py-3 text-left">Judul</th>

                                <th class="px-5 py-3 text-left">Kategori</th>

                                <th class="px-5 py-3 text-right">Nominal</th>

                            </tr>

                        </thead>

                        <tbody class="divide-y">

                            @forelse($penggunaanTerbaru as $item)

                                <tr>

                                    <td class="px-5 py-4">

                                        {{ $item->tanggal->format('d/m/Y') }}

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

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="py-8 text-center text-gray-500">

                                        Belum ada penggunaan dana.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Monitoring --}}
            <div class="bg-white rounded-xl border shadow-sm">

                <div class="border-b px-6 py-4">

                    <h3 class="font-semibold">

                        Monitoring Terakhir

                    </h3>

                </div>

                <div class="grid md:grid-cols-2 gap-6 p-6">

                    <div>

                        <label class="text-sm text-gray-500">

                            Catatan Monitoring

                        </label>

                        <div class="mt-2 rounded-lg border bg-green-50 p-4 min-h-[120px]">

                            {{ $monitoring->catatan_monitoring ?? 'Belum ada catatan.' }}

                        </div>

                    </div>

                    <div>

                        <label class="text-sm text-gray-500">

                            Peringatan

                        </label>

                        <div class="mt-2 rounded-lg border bg-red-50 p-4 min-h-[120px]">

                            {{ $monitoring->peringatan ?? 'Tidak ada peringatan.' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', () => {

            renderDashboardCharts({

                kategori: {

                    labels: @json($kategoriChart->pluck('nama')),

                    values: @json($kategoriChart->pluck('total'))

                },

                monitoring: [0,0],

                bulanan: {

                    labels: @json($bulananChart->pluck('bulan')),

                    values: @json($bulananChart->pluck('total'))

                }

            });

        });

    </script>

    @endpush

</x-app-layout>