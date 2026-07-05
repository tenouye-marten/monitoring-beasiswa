<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold">

                Detail Mahasiswa

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Informasi lengkap mahasiswa penerima bantuan studi.

            </p>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-xl border shadow-sm">

                <div class="p-6 space-y-8">

                    {{-- Informasi Mahasiswa --}}
                    <div>

                        <h3 class="text-lg font-semibold border-b pb-2">

                            Informasi Mahasiswa

                        </h3>

                        <div class="grid md:grid-cols-2 gap-6 mt-5">

                            <div>

                                <p class="text-sm text-gray-500">

                                    Nama Mahasiswa

                                </p>

                                <p class="mt-1 font-semibold">

                                    {{ $mahasiswa->nama }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    NIM

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->nim }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Email

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->email ?: '-' }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Nomor HP

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->no_hp ?: '-' }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Perguruan Tinggi

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->perguruan_tinggi }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Program Studi

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->program_studi }}

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Informasi Beasiswa --}}
                    <div>

                        <h3 class="text-lg font-semibold border-b pb-2">

                            Informasi Beasiswa

                        </h3>

                        <div class="grid md:grid-cols-2 gap-6 mt-5">

                            <div>

                                <p class="text-sm text-gray-500">

                                    Jenis Beasiswa

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->jenis_beasiswa }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Tahun

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->tahun }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Semester

                                </p>

                                <p class="mt-1">

                                    {{ $mahasiswa->semester }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Nominal Beasiswa

                                </p>

                                <p class="mt-1 font-semibold text-green-600">

                                    Rp {{ number_format($mahasiswa->nominal_beasiswa,0,',','.') }}

                                </p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Status

                                </p>

                                <span class="inline-flex mt-1 rounded-full px-3 py-1 text-sm font-medium
                                    {{ $mahasiswa->status == 'Aktif'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">

                                    {{ $mahasiswa->status }}

                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="flex justify-end gap-3 border-t pt-5">

                        <a href="{{ route('admin.mahasiswa.index') }}">

                            <x-secondary-button>

                                Kembali

                            </x-secondary-button>

                        </a>

                        <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}">

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