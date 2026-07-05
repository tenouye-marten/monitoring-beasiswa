<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold">

                Import Data Mahasiswa

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Import data mahasiswa penerima bantuan studi menggunakan file Excel.

            </p>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto px-6">

            @if(session('success'))

                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

                    {{ session('success') }}

                </div>

            @endif

            <div class="bg-white rounded-xl border shadow-sm">

                <form
                    method="POST"
                    action="{{ route('admin.mahasiswa.storeImport') }}"
                    enctype="multipart/form-data"
                    class="p-6 space-y-6">

                    @csrf

                    <div>

                        <x-input-label
                            for="file"
                            value="File Excel" />

                        <input
                            id="file"
                            name="file"
                            type="file"
                            accept=".xlsx,.xls"
                            class="mt-1 w-full rounded-lg border-gray-300">

                        <x-input-error
                            :messages="$errors->get('file')"
                            class="mt-2" />

                    </div>

                    <div class="rounded-lg bg-gray-50 border p-4">

                        <h3 class="font-semibold">

                            Ketentuan

                        </h3>

                        <ul class="mt-2 list-disc list-inside text-sm text-gray-600 space-y-1">

                            <li>Gunakan file Excel (.xlsx / .xls).</li>

                            <li>Baris pertama merupakan heading.</li>

                            <li>NIM tidak boleh duplikat.</li>

                            <li>Email wajib diisi.</li>

                            <li>Password awal menggunakan NIM.</li>

                        </ul>

                    </div>

                    <div class="flex justify-end gap-3 border-t pt-5">

                        <a href="{{ route('admin.mahasiswa.index') }}">

                            <x-secondary-button>

                                Batal

                            </x-secondary-button>

                        </a>

                        <a href="{{ route('admin.mahasiswa.template') }}">

                            <x-secondary-button>

                                Template

                            </x-secondary-button>

                        </a>

                        <x-primary-button>

                            Import Data

                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>