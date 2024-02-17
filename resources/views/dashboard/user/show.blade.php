<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <div class="w-full mt-1">
                        <x-form.label for="name" :value="__('Nama')" class="font-semibold text-lg" />
                        <x-form.input type="text" name="name" id="name" class="w-full" placeholder="{{ $user->name}}" :disabled="true"/>
                    </div>
                    <div class="w-full mt-1">
                        <x-form.label for="email" :value="__('Email')" class="font-semibold text-lg" />
                        <x-form.input type="email" required name="email" id="email" class="w-full" placeholder="{{ $user->email}}" :disabled="true"/>
                    </div>
                    <div class="w-full mt-1">
                        <x-form.label for="role" :value="__('Peran')" class="font-semibold text-lg" />
                        <x-form.select id="role" name="role" :disabled="true">
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
                    <div class="flex gap-2 mt-5">
                        <a href="{{ route('book-categories.index') }}">
                            <x-danger-button type="button">
                                Kembali
                            </x-danger-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
