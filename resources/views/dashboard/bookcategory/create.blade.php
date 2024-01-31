<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create Book Category') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <form action="{{ route('book-categories.store') }}" method="POST">
                        @csrf
                        <div class="w-full my-1">
                            <x-form.label for="name" :value="__('Title')" class="font-semibold text-lg" />
                            <x-form.input type="text" placeholder="Enter Title" name="name" id="name" class="w-full" />
                            <div class="mt-2">
                                @error('name')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="w-full my-1">
                            <x-form.label for="description" :value="__('Description')" class="font-semibold text-lg" />
                            <x-form.textarea name="description" id="description" placeholder="Enter Description" class="w-full"/>
                            <div class="mt-2">
                                @error('descripiton')
                                    <x-form.error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="flex gap-2 mt-5">
                                <x-primary-button>
                                    Save Changes
                                </x-primary-button>
                            <a href="{{ route('book-categories.index') }}">
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
