<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Buku') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <x-input-label for="image" :value="__('Gambar Sebelumnya')" />
                            <br>
                            <img src="{{ asset('storage/book/' . $book->image) }}"  class="img-fluid w-1/4" alt="...">
                        </div>
                        <div class="w-full my-1">
                            <x-form.label class="font-semibold text-lg " value="Kategori" for="book_category_id" />
                            <x-form.select name="book_category_id" id="book_category_id">
                                <option disabled hidden {{ old('Category') != null ?: 'selected' }}>
                                    {{ __('Pilih Kategori') }}
                                </option>
                                @foreach ($bookCategory as $category)
                                    <option value="{{ $category->id }}" @selected(!empty($book) && $category->id == $book->book_category_id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                                <div class="mt-2">
                                    @error('book_category_id')
                                        <x-form.error :messages="$message" />
                                    @enderror
                                </div>
                            </x-form.select>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="title" :value="__('Judul')" class="font-semibold text-lg" />
                            <x-form.input type="text" placeholder="{{ $book->title}}" name="title" id="title"
                                class="w-full" :value="old('title', $book ?? null)"/>
                            <div class="mt-2">
                                @error('title')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="image" :value="__('Gambar')" class="font-semibold text-lg" />
                            <x-form.file-input type="file" placeholder="Pilih Gambar" name="image" id="image"
                                class="w-full" />
                            <div class="mt-2">
                                @error('image')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="description" :value="__('Deskripsi')" class="font-semibold text-lg" />
                            <x-form.textarea type="text" placeholder="{{ $book->description}}" name="description" id="description"
                                class="w-full" :value="old('description', $book ?? null)"/>
                            <div class="mt-2">
                                @error('description')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="author" :value="__('Penulis')" class="font-semibold text-lg" />
                            <x-form.input type="text" placeholder="{{ $book->author}}" name="author" id="author"
                                class="w-full" :value="old('author', $book ?? null)"/>
                            <div class="mt-2">
                                @error('author')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="publish_date" :value="__('Tanggal Terbit')" class="font-semibold text-lg" />
                            <x-form.input type="date" placeholder="{{ $book->publish_date}}" name="publish_date" id="publish_date"
                                class="w-full" />
                            <div class="mt-2">
                                @error('publish_date')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="stock" :value="__('Stok')" class="font-semibold text-lg" />
                            <x-form.input type="text" placeholder="{{ $book->stock}}" name="stock" id="stock"
                                class="w-full" :value="old('stock', $book ?? null)"/>
                            <div class="mt-2">
                                @error('stock')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="flex gap-2 mt-5">
                                <x-primary-button>
                                    Simpan Perubahan
                                </x-primary-button>
                            <a href="{{ route('book.index') }}">
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
