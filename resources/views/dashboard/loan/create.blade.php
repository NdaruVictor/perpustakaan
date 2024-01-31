<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Loans Create') }}
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
                            <x-form.label class="font-semibold text-lg " value="User Name" for="user_id" />
                            <x-form.select name="user_id" id="user_id">
                                <option>
                                    {{ __('Select Category') }}
                                </option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($user->id === $user->id) selected @endif>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                <div class="mt-2">
                                    @error('user_id')
                                        <x-form.error :messages="$message" />
                                    @enderror
                                </div>
                            </x-form.select>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label class="font-semibold text-lg " value="Book" for="book_id" />
                            <x-form.select name="book_id" id="book_id">
                                <option>
                                    {{ __('Select Category') }}
                                </option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" @selected(!empty($book) && $book->id == $book->book_id)>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                                <div class="mt-2">
                                    @error('book_id')
                                        <x-form.error :messages="$message" />
                                    @enderror
                                </div>
                            </x-form.select>
                        </div>
                        <div class="flex gap-2 mt-5">
                                <x-primary-button>
                                    Save Changes
                                </x-primary-button>
                            <a href="{{ route('loans.index') }}">
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
