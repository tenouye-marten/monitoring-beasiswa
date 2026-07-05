<x-app-layout>

    <x-slot name="header">

        <h2 class="text-xl font-semibold text-gray-800">

            Verifikasi Penggunaan Dana

        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <form
                    method="POST"
                    action="{{ route('keuangan.penggunaan-beasiswa.updateVerifikasi',$penggunaanBeasiswa) }}">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <x-input-label
                                :value="__('Nama Mahasiswa')" />

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->mahasiswa->nama"
                                readonly />

                        </div>

                        <div>

                            <x-input-label
                                :value="__('NIM')" />

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->mahasiswa->nim"
                                readonly />

                        </div>

                        <div>

                            <x-input-label
                                :value="__('Kategori')" />

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="$penggunaanBeasiswa->kategori->nama"
                                readonly />

                        </div>

                        <div>

                            <x-input-label
                                :value="__('Nominal')" />

                            <x-text-input
                                class="block mt-1 w-full"
                                :value="'Rp '.number_format($penggunaanBeasiswa->nominal,0,',','.')"
                                readonly />

                        </div>

                    </div>

                    <div class="mt-6">

                        <x-input-label
                            for="status"
                            :value="__('Status Verifikasi')" />

                        <select
                            id="status"
                            name="status"
                            class="mt-1 block w-full rounded-md border-gray-300">

                            <option value="">

                                Pilih Status

                            </option>

                            <option value="Disetujui">

                                Disetujui

                            </option>

                            <option value="Ditolak">

                                Ditolak

                            </option>

                        </select>

                        <x-input-error
                            :messages="$errors->get('status')"
                            class="mt-2"/>

                    </div>

                    <div class="mt-6">

                        <x-input-label
                            for="catatan_verifikasi"
                            :value="__('Catatan Verifikasi')" />

                        <textarea
                            id="catatan_verifikasi"
                            name="catatan_verifikasi"
                            rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300"></textarea>

                        <x-input-error
                            :messages="$errors->get('catatan_verifikasi')"
                            class="mt-2"/>

                    </div>

                    <div class="mt-8 flex gap-3">

                        <x-primary-button>

                            Simpan Verifikasi

                        </x-primary-button>

                        <a href="{{ route('keuangan.penggunaan-beasiswa.index') }}">

                            <x-secondary-button type="button">

                                Kembali

                            </x-secondary-button>

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>