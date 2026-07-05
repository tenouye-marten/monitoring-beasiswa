<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold">

            Tambah Penggunaan Dana

        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border p-6">

                <form
                    action="{{ route('mahasiswa.penggunaan-beasiswa.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @include('mahasiswa.penggunaan-beasiswa._form')

                </form>

            </div>

        </div>

    </div>

</x-app-layout>