<section>

    <div class="mb-6">

        <h2 class="text-xl font-semibold">

            Informasi Profil

        </h2>

        <p class="mt-1 text-sm text-gray-500">

            Perbarui informasi akun Anda.

        </p>

    </div>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
        class="space-y-6">

        @csrf
        @method('PATCH')

        <div>

            <x-input-label
                for="name"
                value="Nama Lengkap" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2" />

        </div>

        <div>

            <x-input-label
                for="email"
                value="Email" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2" />

        </div>

        <div class="flex justify-end gap-3 border-t pt-5">

            @if(session('status') === 'profile-updated')

                <span class="text-sm text-green-600">

                    Profil berhasil diperbarui.

                </span>

            @endif

            <x-primary-button>

                Simpan Perubahan

            </x-primary-button>

        </div>

    </form>

</section>