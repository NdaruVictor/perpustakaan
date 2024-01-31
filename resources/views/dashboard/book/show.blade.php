<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Book Detail') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <div class="w-full my-1">
                        <x-form.label for="image" :value="__('Image')" class="font-semibold text-lg" />
                        <img src="{{ asset('storage/book/' . $book->image) }}" class="w-1/4" alt="">
                    </div>
                    <div class="w-full my-1">
                        <x-form.label class="font-semibold text-lg " value="Category" for="book_category_id" />
                        <x-form.select name="book_category_id" id="book_category_id" :disabled="true">
                            <option>
                                {{ __('Not Category Select') }}
                            </option>
                            @foreach ($bookCategory as $cateogry)
                                <option value="{{ $cateogry->id }}" @selected(!empty($book) && $cateogry->id == $book->book_category_id)>
                                    {{ $cateogry->name }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <div class="w-full my-1">
                        <x-form.label for="book_code" :value="__('Book Code')" class="font-semibold text-lg" />
                        <x-form.input type="text" placeholder="{{ $book->book_code }}" name="book_code"
                            id="book_code" class="w-full" :disabled="true" />
                    </div>
                    <div class="w-full my-1">
                        <x-form.label for="title" :value="__('Title')" class="font-semibold text-lg" />
                        <x-form.input type="text" placeholder="{{ $book->title }}" name="title" id="title"
                            class="w-full" :disabled="true" />
                    </div>
                    <div class="w-full my-1">
                        <x-form.label for="author" :value="__('Author')" class="font-semibold text-lg" />
                        <x-form.input type="text" placeholder="{{ $book->author }}" name="author" id="author"
                            class="w-full" :disabled="true" />
                    </div>
                    <div class="w-full my-1">
                        <x-form.label for="publish_date" :value="__('publish_date')" class="font-semibold text-lg" />
                        <x-form.input type="text" placeholder="{{ $book->publish_date}}" name="publish_date" id="publish_date"
                            class="w-full" :disabled="true" />
                    </div>
                    <div class="w-full my-1">
                        <x-form.label for="stock" :value="__('Stock')" class="font-semibold text-lg" />
                        <x-form.input type="text" placeholder="{{ $book->stock}}" name="stock" id="stock"
                            class="w-full" :disabled="true"/>
                    </div>
                    <div class="flex gap-2 mt-5">
                        <a href="{{ route('book.index') }}">
                            <x-danger-button type="button">
                                Back
                            </x-danger-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
