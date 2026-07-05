<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold text-gray-900">

            Monitoring Penggunaan Dana

        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow-sm border">

                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('monitoring.penggunaan-beasiswa.updateMonitoring',$penggunaanBeasiswa) }}">

                        @csrf

                        @method('PUT')


                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>

                                <x-input-label
                                    value="Nama Mahasiswa"/>

                                <x-text-input
                                    class="block mt-1 w-full"
                                    :value="$penggunaanBeasiswa->mahasiswa->nama"
                                    readonly/>

                            </div>

                            <div>

                                <x-input-label
                                    value="NIM"/>

                                <x-text-input
                                    class="block mt-1 w-full"
                                    :value="$penggunaanBeasiswa->mahasiswa->nim"
                                    readonly/>

                            </div>

                            <div>

                                <x-input-label
                                    value="judul"/>

                                <x-text-input
                                    class="block mt-1 w-full"
                                    :value="$penggunaanBeasiswa->judul"
                                    readonly/>

                            </div>

                            <div>

                                <x-input-label
                                    value="Kategori"/>

                                <x-text-input
                                    class="block mt-1 w-full"
                                    :value="$penggunaanBeasiswa->kategori->nama"
                                    readonly/>

                            </div>

                            <div>

                                <x-input-label
                                    value="Nominal"/>

                                <x-text-input
                                    class="block mt-1 w-full"
                                    :value="'Rp '.number_format($penggunaanBeasiswa->nominal,0,',','.')"
                                    readonly/>

                            </div>

                        </div>

                                                <div class="mt-8">

                            <x-input-label
                                for="status_monitoring"
                                :value="__('Status Monitoring')" />

                            <select
                                id="status_monitoring"
                                name="status_monitoring"
                                class="mt-1 block w-full rounded-md border-gray-300">

                                <option value="Belum Ditinjau"
                                    @selected(old('status_monitoring',$penggunaanBeasiswa->status_monitoring)=='Belum Ditinjau')>

                                    Belum Ditinjau

                                </option>

                                <option value="Sudah Ditinjau"
                                    @selected(old('status_monitoring',$penggunaanBeasiswa->status_monitoring)=='Sudah Ditinjau')>

                                    Sudah Ditinjau

                                </option>

                                <option value="Perlu Perbaikan"
                                    @selected(old('status_monitoring',$penggunaanBeasiswa->status_monitoring)=='Perlu Perbaikan')>

                                    Perlu Perbaikan

                                </option>

                            </select>

                            <x-input-error
                                :messages="$errors->get('status_monitoring')"
                                class="mt-2"/>

                        </div>

                                                <div class="mt-6">

                            <x-input-label
                                for="catatan_monitoring"
                                :value="__('Catatan Monitoring')" />

                            <textarea
                                id="catatan_monitoring"
                                name="catatan_monitoring"
                                rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300">{{ old('catatan_monitoring',$penggunaanBeasiswa->catatan_monitoring) }}</textarea>

                            <x-input-error
                                :messages="$errors->get('catatan_monitoring')"
                                class="mt-2"/>

                        </div>

                                                <div class="mt-6">

                            <x-input-label
                                for="peringatan"
                                :value="__('Peringatan')" />

                            <textarea
                                id="peringatan"
                                name="peringatan"
                                rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300">{{ old('peringatan',$penggunaanBeasiswa->peringatan) }}</textarea>

                            <x-input-error
                                :messages="$errors->get('peringatan')"
                                class="mt-2"/>

                        </div>


                                                <div class="mt-8 flex items-center gap-3">

                            <x-primary-button>

                                Simpan Monitoring

                            </x-primary-button>

                            <a href="{{ route('monitoring.penggunaan-beasiswa.show',$penggunaanBeasiswa) }}">

                                <x-secondary-button
                                    type="button">

                                    Kembali

                                </x-secondary-button>

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>