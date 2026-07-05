<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    Dashboard Admin

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Monitoring Dana Bantuan Studi Kabupaten Mamberamo Tengah

                </p>

            </div>

            <form method="GET">

                <select
                    name="tahun"
                    onchange="this.form.submit()"
                    class="rounded-lg border-gray-300 shadow-sm">

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
                <p class="text-sm text-gray-500">Total Mahasiswa</p>
                <h2 class="mt-2 text-3xl font-bold text-indigo-600">
                    {{ number_format($totalMahasiswa) }}
                </h2>
            </div>

            <div class="bg-white rounded-xl border shadow-sm p-5">
                <p class="text-sm text-gray-500">Dana Beasiswa</p>
                <h2 class="mt-2 text-3xl font-bold text-green-600">
                    Rp {{ number_format($totalDana,0,',','.') }}
                </h2>
            </div>

            <div class="bg-white rounded-xl border shadow-sm p-5">
                <p class="text-sm text-gray-500">Dana Digunakan</p>
                <h2 class="mt-2 text-3xl font-bold text-yellow-500">
                    Rp {{ number_format($totalDigunakan,0,',','.') }}
                </h2>
            </div>

            <div class="bg-white rounded-xl border shadow-sm p-5">
                <p class="text-sm text-gray-500">Sisa Dana</p>
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
                        Status Monitoring
                    </h3>
                </div>

                <div class="p-6 h-80">
                    <canvas id="monitoringChart"></canvas>
                </div>

            </div>

        </div>

        {{-- Bulanan --}}
        <div class="bg-white rounded-xl border shadow-sm">

            <div class="border-b px-6 py-4">

                <h3 class="font-semibold">

                    Penggunaan Dana per Bulan

                </h3>

            </div>

            <div class="p-6 h-96">

                <canvas id="bulananChart"></canvas>

            </div>

        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl border shadow-sm">

            <div class="flex items-center justify-between border-b px-6 py-4">

                <h3 class="font-semibold">

                    Penggunaan Dana Terbaru

                </h3>

                <a
                    href="{{ route('monitoring.penggunaan-beasiswa.index') }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800">

                    Lihat Semua

                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50">

                        <tr class="text-sm text-gray-600">

                            <th class="px-5 py-3 text-left">Tanggal</th>

                            <th class="px-5 py-3 text-left">Mahasiswa</th>

                            <th class="px-5 py-3 text-left">Judul</th>

                            <th class="px-5 py-3 text-left">Kategori</th>

                            <th class="px-5 py-3 text-right">Nominal</th>

                            <th class="px-5 py-3 text-center">Status</th>

                            <th class="px-5 py-3 text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

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

                                    @if($item->tanggal_monitoring)

                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">

                                            Sudah

                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">

                                            Belum

                                        </span>

                                    @endif

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <a
                                        href="{{ route('monitoring.penggunaan-beasiswa.show',$item) }}"
                                        class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-medium text-white hover:bg-indigo-700">

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="py-8 text-center text-gray-500">

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

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded',()=>{

    renderDashboardCharts({

        kategori:{

            labels:@json($kategoriChart->pluck('nama')),

            values:@json($kategoriChart->pluck('total'))

        },

        monitoring:[

            {{ $sudahMonitoring }},

            {{ $belumMonitoring }}

        ],

        bulanan:{

            labels:@json(

                $bulananChart->map(function($item){

                    return \Carbon\Carbon::create()
                        ->month($item->bulan)
                        ->translatedFormat('M');

                })

            ),

            values:@json($bulananChart->pluck('total'))

        }

    });

});

</script>

@endpush
</x-app-layout>

