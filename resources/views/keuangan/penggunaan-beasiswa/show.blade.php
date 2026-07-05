<x-app-layout>

    <x-slot name="header">

        <h2 class="text-xl font-semibold text-gray-800">

            Detail Penggunaan Dana

        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                {{-- ============================== --}}
                {{-- Data Mahasiswa --}}
                {{-- ============================== --}}

                <h3 class="text-lg font-semibold text-gray-800 mb-4">

                    Data Mahasiswa

                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <x-input-label value="Nama Mahasiswa"/>

                        <x-text-input
                            class="block mt-1 w-full"
                            :value="$penggunaanBeasiswa->mahasiswa->nama"
                            readonly/>

                    </div>

                    <div>

                        <x-input-label value="NIM"/>

                        <x-text-input
                            class="block mt-1 w-full"
                            :value="$penggunaanBeasiswa->mahasiswa->nim"
                            readonly/>

                    </div>

                    <div>

                        <x-input-label value="Perguruan Tinggi"/>

                        <x-text-input
                            class="block mt-1 w-full"
                            :value="$penggunaanBeasiswa->mahasiswa->perguruan_tinggi"
                            readonly/>

                    </div>

                    <div>

                        <x-input-label value="Program Studi"/>

                        <x-text-input
                            class="block mt-1 w-full"
                            :value="$penggunaanBeasiswa->mahasiswa->program_studi"
                            readonly/>

                    </div>

                </div>

                {{-- ============================== --}}
                {{-- Data Penggunaan --}}
                {{-- ============================== --}}

                <div class="mt-8 border-t pt-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">

                        Data Penggunaan Dana

                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <x-input-label value="Tanggal"/>

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->tanggal->format('d M Y')"
                                readonly/>

                        </div>

                        <div>

                            <x-input-label value="Kategori"/>

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->kategori->nama"
                                readonly/>

                        </div>

                        <div>

                            <x-input-label value="Nominal"/>

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="'Rp '.number_format($penggunaanBeasiswa->nominal,0,',','.')"
                                readonly/>

                        </div>

                        <div>

                            <x-input-label value="Status"/>

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->status"
                                readonly/>

                        </div>

                    </div>

                    <div class="mt-6">

                        <x-input-label value="Deskripsi"/>

                        <textarea
                            rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300"
                            readonly>{{ $penggunaanBeasiswa->deskripsi }}</textarea>

                    </div>

                </div>

                {{-- ============================== --}}
                {{-- Lampiran --}}
                {{-- ============================== --}}

                <div class="mt-8 border-t pt-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">

                        Lampiran

                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <x-input-label value="Bukti Transaksi"/>

                            <a
                                href="{{ asset('storage/'.$penggunaanBeasiswa->bukti_transaksi) }}"
                                target="_blank"
                                class="text-indigo-600 hover:underline">

                                Lihat Bukti Transaksi

                            </a>

                        </div>

                        <div>

                            <x-input-label value="Dokumentasi"/>

                            @if($penggunaanBeasiswa->dokumentasi)

                                <a
                                    href="{{ asset('storage/'.$penggunaanBeasiswa->dokumentasi) }}"
                                    target="_blank"
                                    class="text-indigo-600 hover:underline">

                                    Lihat Dokumentasi

                                </a>

                            @else

                                <span class="text-gray-500">

                                    Tidak ada dokumentasi.

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                {{-- ============================== --}}
                {{-- Verifikasi --}}
                {{-- ============================== --}}

                <div class="mt-8 border-t pt-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">

                        Informasi Verifikasi

                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <x-input-label value="Status"/>

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->status"
                                readonly/>

                        </div>

                        <div>

                            <x-input-label value="Tanggal Verifikasi"/>

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->tanggal_verifikasi ?? '-'"
                                readonly/>

                        </div>

                        <div class="md:col-span-2">

                            <x-input-label value="Catatan Verifikasi"/>

                            <textarea
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300"
                                readonly>{{ $penggunaanBeasiswa->catatan_verifikasi ?? '-' }}</textarea>

                        </div>

                    </div>

                </div>

                {{-- Tombol --}}

                <div class="mt-8 flex gap-3">

                    <a href="{{ route('keuangan.penggunaan-beasiswa.index') }}">

                        <x-secondary-button>

                            Kembali

                        </x-secondary-button>

                    </a>

                    @if($penggunaanBeasiswa->status == 'Menunggu')

                        <a href="{{ route('keuangan.penggunaan-beasiswa.verifikasi',$penggunaanBeasiswa) }}">

                            <x-primary-button>

                                Verifikasi

                            </x-primary-button>

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>