<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Ubah Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="w-full mt-1">
                            <x-form.label for="name" :value="__('Nama')" class="font-semibold text-lg" />
                            <x-form.input type="text" :value="old('name', $user ?? null)" name="name" id="name" class="w-full" placeholder="Masukkan Nama" />
                            <div class="mt-2">
                                @error('name')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full mt-1">
                            <x-form.label for="email" :value="__('Email')" class="font-semibold text-lg" />
                            <x-form.input type="email" :value="old('email', $user ?? null)" required name="email" id="email" class="w-full" placeholder="Masukkan Email" />
                            <div class="mt-2">
                                @error('email')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full mt-1">
                            <x-form.label for="role" :value="__('Peran')" class="font-semibold text-lg" />
                            <x-form.select id="role" name="role">
                                <option disabled hidden {{ old('role') != null ?: 'selected' }}>
                                    {{ __('Pilih Peran') }}
                                </option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" class="text-uppercase" @selected(!empty($user) && $role->id == $user->roles->first()->id)>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="w-full mt-1">
                            <x-form.label for="password" :value="__('Kata Sandi')" class="font-semibold text-lg" />
                            <x-form.input type="password" :value="old('password', $user ?? null)" name="password" id="password" class="w-full" placeholder="Masukkan Kata Sandi" />
                            <div class="mt-2">
                                @error('password')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="flex gap-2 mt-5">
                                <x-primary-button>
                                    Simpan Perubahan
                                </x-primary-button>
                            <a href="{{ route('users.index') }}">
                                <x-danger-button type="button">
                                    Kembali
                                </x-danger-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
