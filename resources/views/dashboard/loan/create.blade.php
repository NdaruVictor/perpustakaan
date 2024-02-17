<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Pembuatan Pinjaman') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <form action="{{ route('loans.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full my-1">
                            <x-form.label class="font-semibold text-lg " value="Nama Pengguna" for="user_id" />
                            <x-form.select name="user_id" id="user_id">
                                <option>
                                    {{ __('Pilih Kategori') }}
                                </option>
                                <option value="{{ auth()->user()->id }}" selected>
                                    {{ auth()->user()->name }}
                                </option>
                                <div class="mt-2">
                                    @error('user_id')
                                        <x-form.error :messages="$message" />
                                    @enderror
                                </div>
                            </x-form.select>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label class="font-semibold text-lg " value="Buku" for="book_id" />
                            <x-form.select name="book_id" id="book_id">
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                                <div class="mt-2">
                                    @error('book_id')
                                        <x-form.error :messages="$message" />
                                    @enderror
                                </div>
                            </x-form.select>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label class="font-semibold text-lg" value="Stock" for="book_id" />
                           <x-form.input ></x-form.input>
                        </div>
                        <div class="flex gap-2 mt-5">
                            <x-primary-button>
                                Simpan
                            </x-primary-button>
                            <a href="{{ route('loans.index') }}">
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
