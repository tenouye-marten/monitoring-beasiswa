<div class="bg-white rounded-xl shadow border sticky top-6">

    <div class="border-b px-6 py-4">

        <h3 class="text-lg font-semibold text-gray-800">

            Form Monitoring

        </h3>

        <p class="mt-1 text-sm text-gray-500">

            Berikan catatan atau peringatan kepada mahasiswa.

        </p>

    </div>

    <div class="p-6 space-y-6">

        {{-- Catatan Monitoring --}}
        <div>

            <x-input-label
                for="catatan_monitoring"
                value="Catatan Monitoring" />

            <textarea
                id="catatan_monitoring"
                name="catatan_monitoring"
                rows="6"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan_monitoring', $penggunaanBeasiswa->catatan_monitoring) }}</textarea>

            <x-input-error
                :messages="$errors->get('catatan_monitoring')"
                class="mt-2" />

        </div>

        {{-- Peringatan --}}
        <div>

            <x-input-label
                for="peringatan"
                value="Peringatan" />

            <textarea
                id="peringatan"
                name="peringatan"
                rows="6"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('peringatan', $penggunaanBeasiswa->peringatan) }}</textarea>

            <x-input-error
                :messages="$errors->get('peringatan')"
                class="mt-2" />

        </div>

        {{-- Informasi Monitoring --}}
        @if($penggunaanBeasiswa->tanggal_monitoring)

            <div class="rounded-lg border border-green-200 bg-green-50 p-4">

                <h4 class="font-semibold text-green-700">

                    Monitoring Terakhir

                </h4>

                <div class="mt-2 text-sm text-gray-700">

                    <p>

                        <strong>Petugas :</strong>

                        {{ optional($penggunaanBeasiswa->petugas)->name }}

                    </p>

                    <p class="mt-1">

                        <strong>Tanggal :</strong>

                        {{ $penggunaanBeasiswa->tanggal_monitoring->format('d F Y H:i') }}

                    </p>

                </div>

            </div>

        @endif

        {{-- Tombol --}}
        <div class="flex justify-end gap-3">

            <a
                href="{{ route('monitoring.penggunaan-beasiswa.show', $penggunaanBeasiswa) }}"
                class="rounded-lg bg-gray-500 px-4 py-2 text-white hover:bg-gray-600">

                Batal

            </a>

            <x-primary-button>

                Simpan Monitoring

            </x-primary-button>

        </div>

    </div>

</div>