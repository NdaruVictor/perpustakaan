<x-guest-layout>
    <x-auth-card>
        <!-- Validasi Error -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid gap-6">
                <!-- Nama -->
                <div class="space-y-2">
                    <x-form.label
                        for="name"
                        :value="__('Nama')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="name"
                            class="block w-full"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            placeholder="{{ __('Nama') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Alamat Email -->
                <div class="space-y-2">
                    <x-form.label
                        for="email"
                        :value="__('Email')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="email"
                            class="block w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="{{ __('Email') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Kata Sandi -->
                <div class="space-y-2">
                    <x-form.label
                        for="password"
                        :value="__('Kata Sandi')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password"
                            class="block w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('Kata Sandi') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="space-y-2">
                    <x-form.label
                        for="password_confirmation"
                        :value="__('Konfirmasi Kata Sandi')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password_confirmation"
                            class="block w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="{{ __('Konfirmasi Kata Sandi') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Daftar') }}</span>
                    </x-button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Sudah memiliki akun?') }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        {{ __('Masuk') }}
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
