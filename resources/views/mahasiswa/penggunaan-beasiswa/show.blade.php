<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold">

            Detail Penggunaan Dana

        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto space-y-6">

            {{-- Informasi --}}

            <div class="bg-white rounded-xl shadow border p-6">

                <h3 class="font-semibold mb-4">

                    Informasi Penggunaan

                </h3>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <p class="text-sm text-gray-500">

                            Tanggal

                        </p>

                        <p>

                            {{ $penggunaanBeasiswa->tanggal->format('d-m-Y') }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Judul

                        </p>

                        <p>

                            {{ $penggunaanBeasiswa->judul }}

                        </p>

                    </div>
                    <div>

                        <p class="text-sm text-gray-500">

                            Kategori

                        </p>

                        <p>

                            {{ $penggunaanBeasiswa->kategori->nama }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Nominal

                        </p>

                        <p class="font-semibold text-green-600">

                            Rp {{ number_format($penggunaanBeasiswa->nominal,0,',','.') }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Deskripsi

                        </p>

                        <p>

                            {{ $penggunaanBeasiswa->deskripsi }}

                        </p>

                    </div>

                </div>

            </div>

            {{-- Lampiran --}}

            <div class="grid md:grid-cols-2 gap-6">

                <div class="bg-white rounded-xl shadow border p-6">

                    <h3 class="font-semibold mb-4">

                        Bukti Transaksi

                    </h3>

                    <a
                        href="{{ asset('storage/'.$penggunaanBeasiswa->bukti_transaksi) }}"
                        target="_blank"
                        class="text-indigo-600 hover:underline">

                        Lihat Bukti

                    </a>

                </div>

                <div class="bg-white rounded-xl shadow border p-6">

                    <h3 class="font-semibold mb-4">

                        Dokumentasi

                    </h3>

                    @if($penggunaanBeasiswa->dokumentasi)

                        <a
                            href="{{ asset('storage/'.$penggunaanBeasiswa->dokumentasi) }}"
                            target="_blank"
                            class="text-indigo-600 hover:underline">

                            Lihat Dokumentasi

                        </a>

                    @else

                        <span class="text-gray-500">

                            Tidak ada dokumentasi

                        </span>

                    @endif

                </div>

            </div>

            {{-- Monitoring --}}

            <div class="bg-white rounded-xl shadow border p-6">

                <h3 class="font-semibold mb-4">

                    Hasil Monitoring

                </h3>

                <div class="space-y-5">

                    <div>

                        <p class="text-sm text-gray-500">

                            Catatan

                        </p>

                        <div class="mt-2 bg-green-50 border rounded-lg p-4">

                            {{ $penggunaanBeasiswa->catatan_monitoring ?: 'Belum ada catatan.' }}

                        </div>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Peringatan

                        </p>

                        <div class="mt-2 bg-red-50 border rounded-lg p-4">

                            {{ $penggunaanBeasiswa->peringatan ?: 'Tidak ada peringatan.' }}

                        </div>

                    </div>

                </div>

            </div>

            {{-- Tombol --}}

            <div>

                <a
                    href="{{ route('mahasiswa.penggunaan-beasiswa.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">

                    Kembali

                </a>

            </div>

        </div>

    </div>

</x-app-layout>