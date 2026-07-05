<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold">

                    Data Mahasiswa

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Data penerima bantuan studi.

                </p>

            </div>

            <div class="flex gap-2">

                <a href="{{ route('admin.mahasiswa.template') }}">

                    <x-secondary-button>

                        Template

                    </x-secondary-button>

                </a>

                <a href="{{ route('admin.mahasiswa.import.log') }}">

                    <x-secondary-button>

                        Riwayat

                    </x-secondary-button>

                </a>

                <a href="{{ route('admin.mahasiswa.import') }}">

                    <x-primary-button>

                        Import

                    </x-primary-button>

                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6 space-y-6">

            @if(session('success'))

                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

                    {{ session('success') }}

                </div>

            @endif

            @if($errors->any())

                <div class="rounded-lg border border-red-200 bg-red-50 p-4">

                    <ul class="list-disc list-inside text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- Statistik --}}
            <div class="grid md:grid-cols-4 gap-5">

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">

                        Total Mahasiswa

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-indigo-600">

                        {{ $mahasiswas->total() }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">

                        Aktif

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-green-600">

                        {{ \App\Models\Mahasiswa::where('status','Aktif')->count() }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">

                        Nonaktif

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-red-600">

                        {{ \App\Models\Mahasiswa::where('status','Nonaktif')->count() }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">

                        Dana Beasiswa

                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-amber-600">

                        Rp {{ number_format(\App\Models\Mahasiswa::sum('nominal_beasiswa'),0,',','.') }}

                    </h2>

                </div>

            </div>

            <div class="bg-white rounded-xl border shadow-sm p-6">

                <form method="GET" class="grid md:grid-cols-5 gap-4">

                    <x-text-input
                        name="search"
                        class="md:col-span-2"
                        placeholder="Cari mahasiswa..."
                        :value="request('search')" />

                    <select
                        name="tahun"
                        class="rounded-lg border-gray-300">

                        <option value="">Semua Tahun</option>

                        @foreach($tahuns as $tahun)

                            <option
                                value="{{ $tahun }}"
                                @selected(request('tahun')==$tahun)>

                                {{ $tahun }}

                            </option>

                        @endforeach

                    </select>

                    <select
                        name="jenis_beasiswa"
                        class="rounded-lg border-gray-300">

                        <option value="">Semua Jenis</option>

                        <option value="OTSUS">OTSUS</option>

                        <option value="ADIK">ADIK</option>

                        <option value="Prestasi">Prestasi</option>

                        <option value="Afirmasi">Afirmasi</option>

                    </select>

                    <select
                        name="status"
                        class="rounded-lg border-gray-300">

                        <option value="">Semua Status</option>

                        <option value="Aktif">Aktif</option>

                        <option value="Nonaktif">Nonaktif</option>

                    </select>

                    <div class="md:col-span-5 flex gap-2">

                        <x-primary-button>

                            Cari

                        </x-primary-button>

                        <a href="{{ route('admin.mahasiswa.index') }}">

                            <x-secondary-button>

                                Reset

                            </x-secondary-button>

                        </a>

                    </div>

                </form>

            </div>

            <div class="bg-white rounded-xl border shadow-sm">
                <div class="overflow-x-auto">

    <table class="w-full text-sm">

        <thead class="bg-gray-50">

            <tr>

                <th class="px-4 py-3 text-left">No</th>

                <th class="px-4 py-3 text-left">Mahasiswa</th>

                <th class="px-4 py-3 text-left">Perguruan Tinggi</th>

                <th class="px-4 py-3 text-left">Program Studi</th>

                <th class="px-4 py-3 text-left">Jenis</th>

                <th class="px-4 py-3 text-right">Nominal</th>

                <th class="px-4 py-3 text-center">Status</th>

                <th class="px-4 py-3 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody class="divide-y">

            @forelse($mahasiswas as $item)

                <tr>

                    <td class="px-4 py-3">

                        {{ $mahasiswas->firstItem() + $loop->index }}

                    </td>

                    <td class="px-4 py-3">

                        <div class="font-semibold">

                            {{ $item->nama }}

                        </div>

                        <div class="text-xs text-gray-500">

                            {{ $item->nim }}

                        </div>

                    </td>

                    <td class="px-4 py-3">

                        {{ $item->perguruan_tinggi }}

                    </td>

                    <td class="px-4 py-3">

                        {{ $item->program_studi }}

                    </td>

                    <td class="px-4 py-3">

                        {{ $item->jenis_beasiswa }}

                    </td>

                    <td class="px-4 py-3 text-right font-semibold text-green-600">

                        Rp {{ number_format($item->nominal_beasiswa,0,',','.') }}

                    </td>

                    <td class="px-4 py-3 text-center">

                        <span class="rounded-full px-3 py-1 text-xs

                        {{ $item->status=='Aktif'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}">

                            {{ $item->status }}

                        </span>

                    </td>

                    <td class="px-4 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.mahasiswa.show',$item) }}">

                                <x-secondary-button>

                                    Detail

                                </x-secondary-button>

                            </a>

                            <a href="{{ route('admin.mahasiswa.edit',$item) }}">

                                <x-primary-button>

                                    Edit

                                </x-primary-button>

                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.mahasiswa.destroy',$item) }}">

                                @csrf
                                @method('DELETE')

                                <x-danger-button
                                    onclick="return confirm('Hapus data?')">

                                    Hapus

                                </x-danger-button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8"
                        class="py-10 text-center text-gray-500">

                        Belum ada data mahasiswa.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="p-6 border-t">

    {{ $mahasiswas->links() }}

</div>

</div>

</div>

</div>

</x-app-layout>