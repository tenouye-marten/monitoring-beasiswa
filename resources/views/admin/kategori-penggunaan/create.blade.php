<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold">

                Tambah Kategori Penggunaan

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Tambahkan kategori penggunaan dana bantuan studi.

            </p>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-xl border shadow-sm">

                <form
                    method="POST"
                    action="{{ route('admin.kategori-penggunaan.store') }}"
                    class="p-6 space-y-6">

                    @csrf

                    @include('admin.kategori-penggunaan.form')

                    <div class="flex justify-end gap-3 border-t pt-5">

                        <a href="{{ route('admin.kategori-penggunaan.index') }}">

                            <x-secondary-button>

                                Batal

                            </x-secondary-button>

                        </a>

                        <x-primary-button>

                            Simpan

                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>