<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Buat Kategori Buku') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <div class="w-full my-1">
                        <x-form.label for="title" :value="__('Judul')" class="font-semibold text-lg" />
                        <x-form.input type="text" placeholder="{{ $bookcategory->name}}" name="name" id="name" class="w-full" :disabled="true"/>
                    </div>
                    <div class="w-full my-1">
                        <x-form.label for="description" :value="__('Deskripsi')" class="font-semibold text-lg" />
                        <x-form.textarea name="description" id="description" placeholder="{{ $bookcategory->description}}" class="w-full" :disabled="true"/>
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
