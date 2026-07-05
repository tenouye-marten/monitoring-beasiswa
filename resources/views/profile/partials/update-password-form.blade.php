<section>

    <div class="mb-6">

        <h2 class="text-xl font-semibold">

            Ubah Password

        </h2>

        <p class="mt-1 text-sm text-gray-500">

            Gunakan password yang kuat untuk menjaga keamanan akun Anda.

        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.update') }}"
        class="space-y-6">

        @csrf
        @method('PUT')

        <div>

            <x-input-label
                for="current_password"
                value="Password Saat Ini" />

            <x-text-input
                id="current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="current-password" />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2" />

        </div>

        <div>

            <x-input-label
                for="password"
                value="Password Baru" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2" />

        </div>

        <div>

            <x-input-label
                for="password_confirmation"
                value="Konfirmasi Password Baru" />

            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2" />

        </div>

        <div class="flex justify-end gap-3 border-t pt-5">

            @if(session('status') === 'password-updated')

                <span class="text-sm text-green-600">

                    Password berhasil diperbarui.

                </span>

            @endif

            <x-primary-button>

                Simpan Password

            </x-primary-button>

        </div>

    </form>

</section>