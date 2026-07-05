<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    Penggunaan Dana Beasiswa

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Kelola penggunaan dana beasiswa Anda.

                </p>

            </div>

            <a
                href="{{ route('mahasiswa.penggunaan-beasiswa.create') }}"
                class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">

                + Tambah Penggunaan

            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-xl shadow-sm border p-6">

                    <p class="text-sm text-gray-500">

                        Total Beasiswa

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-indigo-600">

                        Rp {{ number_format($totalBeasiswa,0,',','.') }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl shadow-sm border p-6">

                    <p class="text-sm text-gray-500">

                        Dana Digunakan

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-green-600">

                        Rp {{ number_format($totalDigunakan,0,',','.') }}

                    </h2>

                </div>

                <div class="bg-white rounded-xl shadow-sm border p-6">

                    <p class="text-sm text-gray-500">

                        Sisa Dana

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-red-600">

                        Rp {{ number_format($sisaDana,0,',','.') }}

                    </h2>

                </div>

            </div>


            <div class="bg-white rounded-xl border shadow-sm p-6">

                <form method="GET">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>

                            <x-input-label value="Cari" />

                            <x-text-input

                                name="search"

                                class="w-full mt-1"

                                :value="request('search')"

                                placeholder="Cari deskripsi..." />

                        </div>

                        <div>

                            <x-input-label value="Kategori" />

                            <select

                                name="kategori"

                                class="mt-1 w-full rounded-lg border-gray-300">

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

  {{-- ====================================================== --}}
        {{-- Tabel Penggunaan Dana --}}
        {{-- ====================================================== --}}

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

            <div class="px-6 py-4 border-b">

                <h3 class="text-lg font-semibold text-gray-800">

                    Daftar Penggunaan Dana

                </h3>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">

                                No

                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">

                                Tanggal

                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">

                                Judul

                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">

                                Kategori

                            </th>

                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase">

                                Nominal

                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">

                                Catatan

                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase">

                                Peringatan

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

                                {{ $loop->iteration + ($penggunaans->firstItem() - 1) }}

                            </td>

                            <td class="px-4 py-3">

                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}

                            </td>

                            <td class="px-4 py-3">

                                {{ $item->judul }}

                            </td>
                            <td class="px-4 py-3">

                                {{ $item->kategori->nama }}

                            </td>

                            <td class="px-4 py-3 text-right font-medium">

                                Rp {{ number_format($item->nominal,0,',','.') }}

                            </td>

                            {{-- Catatan Monitoring --}}
                            <td class="px-4 py-3">

                                @if($item->catatan_monitoring)

                                <span class="text-green-700 text-sm">

                                    {{ Str::limit($item->catatan_monitoring,40) }}

                                </span>

                                @else

                                <span class="text-gray-400 italic text-sm">

                                    Belum ada

                                </span>

                                @endif

                            </td>

                            {{-- Peringatan --}}
                            <td class="px-4 py-3">

                                @if($item->peringatan)

                                <span class="text-red-600 text-sm">

                                    {{ Str::limit($item->peringatan,40) }}

                                </span>

                                @else

                                <span class="text-gray-400 italic text-sm">

                                    -

                                </span>

                                @endif

                            </td>

                            <td class="px-4 py-3">

                                <div class="flex justify-center gap-2">

                                    <a
                                        href="{{ route('mahasiswa.penggunaan-beasiswa.show',$item) }}"
                                        class="px-3 py-1 rounded bg-blue-500 text-white text-sm hover:bg-blue-600">

                                        Detail

                                    </a>

                                    <a
                                        href="{{ route('mahasiswa.penggunaan-beasiswa.edit',$item) }}"
                                        class="px-3 py-1 rounded bg-yellow-500 text-white text-sm hover:bg-yellow-600">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('mahasiswa.penggunaan-beasiswa.destroy',$item) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus data penggunaan dana ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-3 py-1 rounded bg-red-600 text-white text-sm hover:bg-red-700">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-10 text-gray-500">

                                Belum ada data penggunaan dana.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="px-6 py-4 border-t">

                {{ $penggunaans->links() }}

            </div>

        </div>



        </div>


      

    </div>

    </div>

</x-app-layout>