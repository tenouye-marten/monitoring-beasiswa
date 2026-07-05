<div class="space-y-6">

    {{-- Nama Kategori --}}
    <div>

        <x-input-label
            for="nama"
            value="Nama Kategori" />

        <x-text-input
            id="nama"
            name="nama"
            class="mt-1 block w-full"
            :value="old('nama', $kategoriPenggunaan->nama ?? '')"
            placeholder="Masukkan nama kategori"
            required
            autofocus />

        <x-input-error
            :messages="$errors->get('nama')"
            class="mt-2" />

    </div>

    {{-- Keterangan --}}
    <div>

        <x-input-label
            for="keterangan"
            value="Keterangan" />

        <textarea
            id="keterangan"
            name="keterangan"
            rows="4"
            class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Masukkan keterangan kategori...">{{ old('keterangan', $kategoriPenggunaan->keterangan ?? '') }}</textarea>

        <x-input-error
            :messages="$errors->get('keterangan')"
            class="mt-2" />

    </div>

    {{-- Status --}}
    <div>

        <x-input-label
            for="status"
            value="Status" />

        <select
            id="status"
            name="status"
            class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            <option value="1"
                @selected(old('status', $kategoriPenggunaan->status ?? 1) == 1)>

                Aktif

            </option>

            <option value="0"
                @selected(old('status', $kategoriPenggunaan->status ?? 1) == 0)>

                Nonaktif

            </option>

        </select>

        <x-input-error
            :messages="$errors->get('status')"
            class="mt-2" />

    </div>

</div>