@csrf

<div class="space-y-6">

    {{-- Judul --}}
    <div>

        <x-input-label
            for="judul"
            value="Judul Penggunaan Dana" />

        <x-text-input
            id="judul"
            name="judul"
            type="text"
            class="mt-1 block w-full"
            :value="old('judul', $penggunaanBeasiswa->judul ?? '')"
            placeholder="Contoh : Pembayaran UKT Semester Genap" />

        <x-input-error
            :messages="$errors->get('judul')"
            class="mt-2" />

    </div>

    {{-- Kategori --}}
    <div>

        <x-input-label
            for="kategori_penggunaan_id"
            value="Kategori Penggunaan" />

        <select
            id="kategori_penggunaan_id"
            name="kategori_penggunaan_id"
            class="mt-1 block w-full rounded-lg border-gray-300">

            <option value="">-- Pilih Kategori --</option>

            @foreach($kategoriPenggunaans as $kategori)

                <option
                    value="{{ $kategori->id }}"
                    @selected(old('kategori_penggunaan_id', $penggunaanBeasiswa->kategori_penggunaan_id ?? '') == $kategori->id)>

                    {{ $kategori->nama }}

                </option>

            @endforeach

        </select>

        <x-input-error
            :messages="$errors->get('kategori_penggunaan_id')"
            class="mt-2" />

    </div>

    {{-- Tanggal --}}
    <div>

        <x-input-label
            for="tanggal"
            value="Tanggal Penggunaan" />

        <x-text-input
            id="tanggal"
            type="date"
            name="tanggal"
            class="mt-1 block w-full"
            :value="old('tanggal', isset($penggunaanBeasiswa) ? optional($penggunaanBeasiswa->tanggal)->format('Y-m-d') : '')" />

        <x-input-error
            :messages="$errors->get('tanggal')"
            class="mt-2" />

    </div>

    {{-- Nominal --}}
    <div>

        <x-input-label
            for="nominal"
            value="Nominal Penggunaan" />

        <x-text-input
            id="nominal"
            type="number"
            name="nominal"
            class="mt-1 block w-full"
            :value="old('nominal', $penggunaanBeasiswa->nominal ?? '')"
            placeholder="Contoh : 3500000" />

        <x-input-error
            :messages="$errors->get('nominal')"
            class="mt-2" />

    </div>

    {{-- Deskripsi --}}
    <div>

        <x-input-label
            for="deskripsi"
            value="Keterangan Penggunaan Dana" />

        <textarea
            id="deskripsi"
            name="deskripsi"
            rows="5"
            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('deskripsi', $penggunaanBeasiswa->deskripsi ?? '') }}</textarea>

        <x-input-error
            :messages="$errors->get('deskripsi')"
            class="mt-2" />

    </div>

    {{-- Bukti Transaksi --}}
    <div>

        <x-input-label
            for="bukti_transaksi"
            value="Bukti Transaksi" />

        <input
            id="bukti_transaksi"
            type="file"
            name="bukti_transaksi"
            class="mt-1 block w-full">

        @isset($penggunaanBeasiswa)

            @if($penggunaanBeasiswa->bukti_transaksi)

                <a
                    href="{{ asset('storage/'.$penggunaanBeasiswa->bukti_transaksi) }}"
                    target="_blank"
                    class="mt-2 inline-block text-sm text-indigo-600 hover:underline">

                    Lihat Bukti Transaksi

                </a>

            @endif

        @endisset

        <x-input-error
            :messages="$errors->get('bukti_transaksi')"
            class="mt-2" />

    </div>

    {{-- Dokumentasi --}}
    <div>

        <x-input-label
            for="dokumentasi"
            value="Dokumentasi (Opsional)" />

        <input
            id="dokumentasi"
            type="file"
            name="dokumentasi"
            class="mt-1 block w-full">

        @isset($penggunaanBeasiswa)

            @if($penggunaanBeasiswa->dokumentasi)

                <a
                    href="{{ asset('storage/'.$penggunaanBeasiswa->dokumentasi) }}"
                    target="_blank"
                    class="mt-2 inline-block text-sm text-indigo-600 hover:underline">

                    Lihat Dokumentasi

                </a>

            @endif

        @endisset

        <x-input-error
            :messages="$errors->get('dokumentasi')"
            class="mt-2" />

    </div>

    {{-- Tombol --}}
    <div class="flex justify-end gap-3 pt-2">

        <a
            href="{{ route('mahasiswa.penggunaan-beasiswa.index') }}"
            class="rounded-lg bg-gray-500 px-4 py-2 text-white hover:bg-gray-600">

            Kembali

        </a>

        <x-primary-button>

            Simpan

        </x-primary-button>

    </div>

</div>