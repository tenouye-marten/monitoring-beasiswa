<x-app-layout>

<x-slot name="header">

    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-2xl font-bold">

                Kategori Penggunaan

            </h2>

            <p class="text-sm text-gray-500">

                Master data kategori penggunaan dana.

            </p>

        </div>

        <a href="{{ route('admin.kategori-penggunaan.create') }}">

            <x-primary-button>

                + Tambah

            </x-primary-button>

        </a>

    </div>

</x-slot>

<div class="py-6">

<div class="max-w-7xl mx-auto px-6 space-y-6">

@if(session('success'))

<div class="rounded-lg bg-green-100 border border-green-200 p-4 text-green-700">

    {{ session('success') }}

</div>

@endif

<div class="grid md:grid-cols-3 gap-5">

    <div class="bg-white rounded-xl border p-5">

        <p class="text-sm text-gray-500">

            Total

        </p>

        <h2 class="text-3xl font-bold text-indigo-600">

            {{ $totalKategori }}

        </h2>

    </div>

    <div class="bg-white rounded-xl border p-5">

        <p class="text-sm text-gray-500">

            Aktif

        </p>

        <h2 class="text-3xl font-bold text-green-600">

            {{ $kategoriAktif }}

        </h2>

    </div>

    <div class="bg-white rounded-xl border p-5">

        <p class="text-sm text-gray-500">

            Nonaktif

        </p>

        <h2 class="text-3xl font-bold text-red-600">

            {{ $kategoriNonaktif }}

        </h2>

    </div>

</div>

<div class="bg-white rounded-xl border shadow-sm">

    <div class="p-6">

        {{-- Filter --}}
        <form method="GET"
            class="mb-6 flex flex-wrap gap-3">

            <x-text-input
                name="search"
                class="w-72"
                :value="request('search')"
                placeholder="Cari kategori..." />

            <select
                name="status"
                class="rounded-lg border-gray-300">

                <option value="">Semua Status</option>

                <option
                    value="1"
                    @selected(request('status')=='1')>

                    Aktif

                </option>

                <option
                    value="0"
                    @selected(request('status')=='0')>

                    Nonaktif

                </option>

            </select>

            <x-primary-button>

                Cari

            </x-primary-button>

            <a href="{{ route('admin.kategori-penggunaan.index') }}">

                <x-secondary-button>

                    Reset

                </x-secondary-button>

            </a>

        </form>

        {{-- Tabel --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left">No</th>

                        <th class="px-4 py-3 text-left">Nama</th>

                        <th class="px-4 py-3 text-left">Keterangan</th>

                        <th class="px-4 py-3 text-center">Status</th>

                        <th class="px-4 py-3 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($kategoriPenggunaans as $item)

                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3">

                                {{ $kategoriPenggunaans->firstItem() + $loop->index }}

                            </td>

                            <td class="px-4 py-3 font-medium">

                                {{ $item->nama }}

                            </td>

                            <td class="px-4 py-3 text-gray-600">

                                {{ $item->keterangan }}

                            </td>

                            <td class="px-4 py-3 text-center">

                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $item->status
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">

                                    {{ $item->status ? 'Aktif' : 'Nonaktif' }}

                                </span>

                            </td>

                            <td class="px-4 py-3">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.kategori-penggunaan.show',$item) }}"
                                        class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">

                                        Detail

                                    </a>

                                    <a href="{{ route('admin.kategori-penggunaan.edit',$item) }}"
                                        class="px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('admin.kategori-penggunaan.destroy',$item) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Hapus data ini?')"
                                            class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="py-8 text-center text-gray-500">

                                Belum ada data kategori.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

                {{-- Pagination --}}
        <div class="mt-6">

            {{ $kategoriPenggunaans->links() }}

        </div>

    </div>

</div>

</div>

</div>

</x-app-layout>