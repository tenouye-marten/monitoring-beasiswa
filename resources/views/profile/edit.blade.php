<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold">

                Profil Pengguna

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Kelola informasi akun dan ubah password.

            </p>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto px-6 space-y-6">

            {{-- Informasi Profil --}}
            <div class="bg-white rounded-xl border shadow-sm">

                <div class="p-6">

                    @include('profile.partials.update-profile-information-form')

                </div>

            </div>

            {{-- Password --}}
            <div class="bg-white rounded-xl border shadow-sm">

                <div class="p-6">

                    @include('profile.partials.update-password-form')

                </div>

            </div>

        </div>

    </div>

</x-app-layout>