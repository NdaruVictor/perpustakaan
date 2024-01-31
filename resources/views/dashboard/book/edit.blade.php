<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Book Edit') }}
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
                            <x-input-label for="image" :value="__('Previous Image')" />
                            <br>
                            <img src="{{ asset('storage/book/' . $book->image) }}"  class="img-fluid w-1/4" alt="...">
                        </div>
                        <div class="w-full my-1">
                            <x-form.label class="font-semibold text-lg " value="Category" for="book_category_id" />
                            <x-form.select name="book_category_id" id="book_category_id" :disabled="request()->routeIs('dashboard.novel.show')">
                                <option disabled hidden {{ old('Category') != null ?: 'selected' }}>
                                    {{ __('Select Category') }}
                                </option>
                                @foreach ($bookCategory as $cateogry)
                                    <option value="{{ $cateogry->id }}" @selected(!empty($book) && $cateogry->id == $book->book_category_id)>
                                        {{ $cateogry->name }}
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
                            <x-form.label for="book_code" :value="__('Book Code')" class="font-semibold text-lg" />
                            <x-form.input type="text" placeholder="{{ $book->book_code}}" name="book_code" id="book_code"
                                class="w-full" :value="old('book_code', $book ?? null)"/>
                            <div class="mt-2">
                                @error('book_code')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="title" :value="__('Title')" class="font-semibold text-lg" />
                            <x-form.input type="text" placeholder="{{ $book->title}}" name="title" id="title"
                                class="w-full" :value="old('title', $book ?? null)"/>
                            <div class="mt-2">
                                @error('title')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="image" :value="__('Image')" class="font-semibold text-lg" />
                            <x-form.file-input type="file" placeholder="Select Image" name="image" id="image"
                                class="w-full" />
                            <div class="mt-2">
                                @error('image')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="author" :value="__('Author')" class="font-semibold text-lg" />
                            <x-form.input type="text" placeholder="{{ $book->author}}" name="author" id="author"
                                class="w-full" :value="old('author', $book ?? null)"/>
                            <div class="mt-2">
                                @error('author')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="publish_date" :value="__('publish_date')" class="font-semibold text-lg" />
                            <x-form.input type="date" placeholder="{{ $book->publish_date}}" name="publish_date" id="publish_date"
                                class="w-full" />
                            <div class="mt-2">
                                @error('publish_date')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="stock" :value="__('Stock')" class="font-semibold text-lg" />
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
                                    Save Changes
                                </x-primary-button>
                            <a href="{{ route('book.index') }}">
                                <x-danger-button type="button">
                                    Back
                                </x-danger-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
