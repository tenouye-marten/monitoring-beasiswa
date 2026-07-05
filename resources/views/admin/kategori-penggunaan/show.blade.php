<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold">

                Detail Kategori Penggunaan

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Informasi lengkap kategori penggunaan dana bantuan studi.

            </p>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-xl border shadow-sm">

                <div class="p-6 space-y-6">

                    <div>

                        <p class="text-sm text-gray-500">

                            Nama Kategori

                        </p>

                        <p class="mt-1 text-lg font-semibold">

                            {{ $kategoriPenggunaan->nama }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Keterangan

                        </p>

                        <div class="mt-2 rounded-lg border bg-gray-50 p-4">

                            {{ $kategoriPenggunaan->keterangan ?: '-' }}

                        </div>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Status

                        </p>

                        <span class="mt-2 inline-flex rounded-full px-3 py-1 text-sm font-semibold
                            {{ $kategoriPenggunaan->status
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }}">

                            {{ $kategoriPenggunaan->status ? 'Aktif' : 'Nonaktif' }}

                        </span>

                    </div>

                    <div class="flex justify-end gap-3 border-t pt-5">

                        <a href="{{ route('admin.kategori-penggunaan.index') }}">

                            <x-secondary-button>

                                Kembali

                            </x-secondary-button>

                        </a>

                        <a href="{{ route('admin.kategori-penggunaan.edit', $kategoriPenggunaan) }}">

                            <x-primary-button>

                                Edit

                            </x-primary-button>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>