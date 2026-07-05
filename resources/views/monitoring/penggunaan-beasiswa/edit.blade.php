<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900">

                    Monitoring Penggunaan Dana Beasiswa

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Berikan catatan atau peringatan berdasarkan penggunaan dana mahasiswa.

                </p>

            </div>

            <a
                href="{{ route('monitoring.penggunaan-beasiswa.index', ['tahun' => request('tahun')]) }}"
                class="inline-flex items-center rounded-lg bg-gray-500 px-4 py-2 text-white hover:bg-gray-600">

                Kembali

            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form
                action="{{ route('monitoring.penggunaan-beasiswa.update', $penggunaanBeasiswa) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- ===================================================== --}}
                    {{-- Informasi Mahasiswa & Penggunaan Dana --}}
                    {{-- ===================================================== --}}

                    <div class="lg:col-span-2 space-y-6">

                        {{-- Data Mahasiswa --}}
                        <div class="bg-white rounded-xl shadow-sm border">

                            <div class="border-b px-6 py-4">

                                <h3 class="text-lg font-semibold">

                                    Data Mahasiswa

                                </h3>

                            </div>

                            <div class="p-6">

                                <div class="grid md:grid-cols-2 gap-6">

                                    <div>

                                        <label class="text-sm text-gray-500">

                                            Nama Mahasiswa

                                        </label>

                                        <p class="font-semibold">

                                            {{ $penggunaanBeasiswa->mahasiswa->nama }}

                                        </p>

                                    </div>

                                    <div>

                                        <label class="text-sm text-gray-500">

                                            NIM

                                        </label>

                                        <p>

                                            {{ $penggunaanBeasiswa->mahasiswa->nim }}

                                        </p>

                                    </div>

                                    <div>

                                        <label class="text-sm text-gray-500">

                                            Perguruan Tinggi

                                        </label>

                                        <p>

                                            {{ $penggunaanBeasiswa->mahasiswa->perguruan_tinggi }}

                                        </p>

                                    </div>

                                    <div>

                                        <label class="text-sm text-gray-500">

                                            Program Studi

                                        </label>

                                        <p>

                                            {{ $penggunaanBeasiswa->mahasiswa->program_studi }}

                                        </p>

                                    </div>

                                    <div>

                                        <label class="text-sm text-gray-500">

                                            Jenis Beasiswa

                                        </label>

                                        <p>

                                            {{ $penggunaanBeasiswa->mahasiswa->jenis_beasiswa }}

                                        </p>

                                    </div>

                                    <div>

                                        <label class="text-sm text-gray-500">

                                            Tahun Beasiswa

                                        </label>

                                        <p>

                                            {{ $penggunaanBeasiswa->mahasiswa->tahun }}

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Data Penggunaan Dana --}}
                        <div class="bg-white rounded-xl shadow-sm border">

                            <div class="border-b px-6 py-4">

                                <h3 class="text-lg font-semibold">

                                    Penggunaan Dana

                                </h3>

                            </div>

                            <div class="p-6 space-y-5">

                                <div>

                                    <label class="text-sm text-gray-500">

                                        Kategori

                                    </label>

                                    <p>

                                        {{ $penggunaanBeasiswa->kategori->nama }}

                                    </p>

                                </div>

                                <div>

                                    <label class="text-sm text-gray-500">

                                        Tanggal

                                    </label>

                                    <p>

                                        {{ $penggunaanBeasiswa->tanggal->format('d F Y') }}

                                    </p>

                                </div>

                                <div>

                                    <label class="text-sm text-gray-500">

                                        Nominal

                                    </label>

                                    <p class="text-xl font-bold text-green-600">

                                        Rp {{ number_format($penggunaanBeasiswa->nominal,0,',','.') }}

                                    </p>

                                </div>

                                <div>

                                    <label class="text-sm text-gray-500">

                                        Deskripsi

                                    </label>

                                    <div class="mt-2 rounded-lg border bg-gray-50 p-4">

                                        {{ $penggunaanBeasiswa->deskripsi }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Lampiran --}}
                        <div class="bg-white rounded-xl shadow-sm border">

                            <div class="border-b px-6 py-4">

                                <h3 class="text-lg font-semibold">

                                    Lampiran

                                </h3>

                            </div>

                            <div class="p-6 space-y-3">

                           <div class="bg-white rounded-xl shadow-sm border">

    <div class="border-b px-6 py-4">

        <h3 class="text-lg font-semibold">

            Bukti Transaksi

        </h3>

    </div>

    <div class="p-6">

        @php
            $bukti = $penggunaanBeasiswa->bukti_transaksi;
            $ext = strtolower(pathinfo($bukti, PATHINFO_EXTENSION));
        @endphp

        @if(in_array($ext,['jpg','jpeg','png','webp']))

            <a
                href="{{ asset('storage/'.$bukti) }}"
                target="_blank">

                <img
                    src="{{ asset('storage/'.$bukti) }}"
                    class="rounded-lg border max-h-80 object-contain mx-auto hover:opacity-90 transition">

            </a>

            <div class="mt-3">

                <a
                    href="{{ asset('storage/'.$bukti) }}"
                    target="_blank"
                    class="text-indigo-600 hover:underline">

                    Lihat ukuran penuh

                </a>

            </div>

        @elseif($ext=='pdf')

            <div class="flex items-center gap-3">

                <svg class="w-10 h-10 text-red-600"
                    fill="currentColor"
                    viewBox="0 0 20 20">

                    <path d="M4 2a2 2 0 00-2 2v12a2
                    2 0 002 2h12a2
                    2 0 002-2V7l-5-5H4z"/>

                </svg>

                <div>

                    <div class="font-semibold">

                        File PDF

                    </div>

                    <a
                        href="{{ asset('storage/'.$bukti) }}"
                        target="_blank"
                        class="text-indigo-600 hover:underline">

                        Lihat PDF

                    </a>

                </div>

            </div>

        @endif

    </div>

</div> 

                          <div class="bg-white rounded-xl shadow-sm border">

    <div class="border-b px-6 py-4">

        <h3 class="text-lg font-semibold">

            Dokumentasi

        </h3>

    </div>

    <div class="p-6">

        @if($penggunaanBeasiswa->dokumentasi)

            @php

                $dokumentasi = $penggunaanBeasiswa->dokumentasi;

                $ext = strtolower(pathinfo($dokumentasi, PATHINFO_EXTENSION));

            @endphp

            @if(in_array($ext,['jpg','jpeg','png','webp']))

                <a
                    href="{{ asset('storage/'.$dokumentasi) }}"
                    target="_blank">

                    <img
                        src="{{ asset('storage/'.$dokumentasi) }}"
                        class="rounded-lg border max-h-80 object-contain mx-auto hover:opacity-90">

                </a>

                <div class="mt-3">

                    <a
                        href="{{ asset('storage/'.$dokumentasi) }}"
                        target="_blank"
                        class="text-indigo-600 hover:underline">

                        Lihat ukuran penuh

                    </a>

                </div>

            @elseif($ext=='pdf')

                <a
                    href="{{ asset('storage/'.$dokumentasi) }}"
                    target="_blank"
                    class="text-indigo-600 hover:underline">

                    Lihat PDF Dokumentasi

                </a>

            @endif

        @else

            <div class="text-gray-500">

                Tidak ada dokumentasi.

            </div>

        @endif

    </div>

</div>

                            </div>

                        </div>

                    </div>

                    {{-- ===================================================== --}}
                    {{-- Form Monitoring --}}
                    {{-- ===================================================== --}}

                    <div>

                        @include('monitoring.penggunaan-beasiswa._form')

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>