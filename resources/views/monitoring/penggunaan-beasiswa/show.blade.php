<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    Detail Monitoring Penggunaan Dana

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Informasi lengkap penggunaan dana beasiswa mahasiswa.

                </p>

            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route('monitoring.penggunaan-beasiswa.index',['tahun'=>request('tahun')]) }}"
                    class="px-4 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600">

                    Kembali

                </a>

                <a
                    href="{{ route('monitoring.penggunaan-beasiswa.edit',$penggunaanBeasiswa) }}"
                    class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">

                    Monitoring

                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

         <div class="bg-white rounded-xl border shadow-sm">

    <div class="border-b px-6 py-4">

        <h3 class="font-semibold">

            Data Mahasiswa

        </h3>

    </div>

    <div class="p-6 grid md:grid-cols-2 gap-5">

        <div>
            <p class="text-sm text-gray-500">Nama</p>
            <p class="font-medium">{{ $penggunaanBeasiswa->mahasiswa->nama }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">NIM</p>
            <p>{{ $penggunaanBeasiswa->mahasiswa->nim }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Perguruan Tinggi</p>
            <p>{{ $penggunaanBeasiswa->mahasiswa->perguruan_tinggi }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Program Studi</p>
            <p>{{ $penggunaanBeasiswa->mahasiswa->program_studi }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Jenis Beasiswa</p>
            <p>{{ $penggunaanBeasiswa->mahasiswa->jenis_beasiswa }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Tahun</p>
            <p>{{ $penggunaanBeasiswa->mahasiswa->tahun }}</p>
        </div>

    </div>

</div>


          <div class="bg-white rounded-xl border shadow-sm">

    <div class="border-b px-6 py-4">

        <h3 class="font-semibold">

            Penggunaan Dana

        </h3>

    </div>

    <div class="p-6 space-y-5">

        <div>

            <p class="text-sm text-gray-500">Judul</p>

            <h4 class="font-semibold text-lg">

                {{ $penggunaanBeasiswa->judul }}

            </h4>

        </div>

        <div class="grid md:grid-cols-3 gap-5">

            <div>

                <p class="text-sm text-gray-500">Kategori</p>

                <p>{{ $penggunaanBeasiswa->kategori->nama }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Tanggal</p>

                <p>{{ $penggunaanBeasiswa->tanggal->format('d F Y') }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Nominal</p>

                <p class="font-bold text-green-600">

                    Rp {{ number_format($penggunaanBeasiswa->nominal,0,',','.') }}

                </p>

            </div>

        </div>

        <div>

            <p class="text-sm text-gray-500 mb-2">

                Keterangan

            </p>

            <div class="rounded-lg border bg-gray-50 p-4">

                {{ $penggunaanBeasiswa->deskripsi }}

            </div>

        </div>

    </div>

</div>


         <div class="lg:col-span-2 bg-white rounded-xl border shadow-sm">

    <div class="border-b px-6 py-4">

        <h3 class="font-semibold">

            Lampiran

        </h3>

    </div>

    <div class="p-6 grid md:grid-cols-2 gap-6">

        <div>

            <p class="text-sm text-gray-500 mb-2">

                Bukti Transaksi

            </p>

            <a
                href="{{ asset('storage/'.$penggunaanBeasiswa->bukti_transaksi) }}"
                target="_blank"
                class="text-indigo-600 hover:underline">

                Lihat Bukti Transaksi

            </a>

        </div>

        <div>

            <p class="text-sm text-gray-500 mb-2">

                Dokumentasi

            </p>

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


                <div class="lg:col-span-2 bg-white rounded-xl shadow border">

                    <div class="border-b px-6 py-4">

                        <h3 class="font-semibold text-lg">

                            Hasil Monitoring

                        </h3>

                    </div>

                    <div class="p-6 grid md:grid-cols-2 gap-6">

                        <div>

                            <label class="text-sm text-gray-500">

                                Catatan Monitoring

                            </label>

                            <div class="mt-2 rounded-lg bg-green-50 border p-4 min-h-[120px]">

                                {{ $penggunaanBeasiswa->catatan_monitoring ?? 'Belum ada catatan monitoring.' }}

                            </div>

                        </div>

                        <div>

                            <label class="text-sm text-gray-500">

                                Peringatan

                            </label>

                            <div class="mt-2 rounded-lg bg-red-50 border p-4 min-h-[120px]">

                                {{ $penggunaanBeasiswa->peringatan ?? 'Tidak ada peringatan.' }}

                            </div>

                        </div>

                    </div>

                    @if($penggunaanBeasiswa->dimonitor_oleh)

                    <div class="border-t px-6 py-4 bg-gray-50">

                        <div class="text-sm text-gray-600">

                            <strong>Dimonitor Oleh :</strong>

                            {{ optional($penggunaanBeasiswa->petugas)->name }}

                            <br>

                            <strong>Tanggal Monitoring :</strong>

                            {{ optional($penggunaanBeasiswa->tanggal_monitoring)?->format('d F Y H:i') }}

                        </div>

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>