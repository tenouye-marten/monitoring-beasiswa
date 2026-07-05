<div class="space-y-8">

    {{-- Informasi Mahasiswa --}}
    <div>

        <h3 class="text-lg font-semibold border-b pb-2">

            Informasi Mahasiswa

        </h3>

        <div class="grid md:grid-cols-2 gap-6 mt-5">

            <div>

                <p class="text-sm text-gray-500">Nama Mahasiswa</p>

                <p class="mt-1 font-semibold">{{ $mahasiswa->nama }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">NIM</p>

                <p class="mt-1">{{ $mahasiswa->nim }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Perguruan Tinggi</p>

                <p class="mt-1">{{ $mahasiswa->perguruan_tinggi }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Program Studi</p>

                <p class="mt-1">{{ $mahasiswa->program_studi }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Jenis Beasiswa</p>

                <p class="mt-1">{{ $mahasiswa->jenis_beasiswa }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Semester</p>

                <p class="mt-1">{{ $mahasiswa->semester }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Tahun</p>

                <p class="mt-1">{{ $mahasiswa->tahun }}</p>

            </div>

            <div>

                <p class="text-sm text-gray-500">Nominal Beasiswa</p>

                <p class="mt-1 font-semibold text-green-600">

                    Rp {{ number_format($mahasiswa->nominal_beasiswa,0,',','.') }}

                </p>

            </div>

        </div>

    </div>

    {{-- Informasi Kontak --}}
    <div>

        <h3 class="text-lg font-semibold border-b pb-2">

            Informasi Kontak

        </h3>

        <div class="grid md:grid-cols-2 gap-6 mt-5">

            <div>

                <x-input-label
                    for="email"
                    value="Email" />

                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="mt-1 block w-full"
                    :value="old('email',$mahasiswa->email)" />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2" />

            </div>

            <div>

                <x-input-label
                    for="no_hp"
                    value="Nomor HP" />

                <x-text-input
                    id="no_hp"
                    name="no_hp"
                    class="mt-1 block w-full"
                    :value="old('no_hp',$mahasiswa->no_hp)" />

                <x-input-error
                    :messages="$errors->get('no_hp')"
                    class="mt-2" />

            </div>

            <div class="md:col-span-2">

                <x-input-label
                    for="status"
                    value="Status" />

                <select
                    id="status"
                    name="status"
                    class="mt-1 w-full rounded-lg border-gray-300">

                    <option value="Aktif"
                        @selected(old('status',$mahasiswa->status)=='Aktif')>

                        Aktif

                    </option>

                    <option value="Nonaktif"
                        @selected(old('status',$mahasiswa->status)=='Nonaktif')>

                        Nonaktif

                    </option>

                </select>

                <x-input-error
                    :messages="$errors->get('status')"
                    class="mt-2" />

            </div>

        </div>

    </div>

</div>