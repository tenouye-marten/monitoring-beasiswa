<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold">

                Edit Data Mahasiswa

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Perbarui informasi kontak dan status mahasiswa.

            </p>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-xl border shadow-sm">

                <form
                    method="POST"
                    action="{{ route('admin.mahasiswa.update', $mahasiswa) }}"
                    class="p-6 space-y-8">

                    @csrf
                    @method('PUT')

                    @include('admin.mahasiswa.form')

                    <div class="flex justify-end gap-3 border-t pt-5">

                        <a href="{{ route('admin.mahasiswa.index') }}">

                            <x-secondary-button>

                                Batal

                            </x-secondary-button>

                        </a>

                        <x-primary-button>

                            Simpan Perubahan

                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>