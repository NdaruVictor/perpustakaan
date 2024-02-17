<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Buku') }}
            </h2>
        </div>
    </x-slot>

    <div class="mt-5 container">


        <form class="mx-auto" action="{{ route('books.keyword') }}" method="GET">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" name="search" id="keyword"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-5"
                    placeholder="Search Mockups, Logos..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-500  focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </form>


        <div class="grid md:grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-8">
            @forelse ($books as $book)
                <x-content.card>
                    <a href="{{ route('books.show', $book->id) }}">
                        <img class="w-full h-52 md:h-72 object-cover " src="{{ asset('storage/book/' . $book->image) }}"
                            alt="...">
                        <div class="px-6 py-4">
                            <p class="font-bold text-lg mb-2 text-black">{{ $book->title }}</p>
                            <div class="flex gap-6">
                                <div class="mt-2">
                                    <p class="text-sm text-black">Penulis : {{ $book->author }}</p>
                                    <p class="text-sm text-black">Stock : {{ $book->stock }}</p>
                                </div>
                                <div class="mt-2">
                                    <x-button variant="primary" href="{{ route('loan.create', $book->id) }}">
                                        <i class="text-xs">Pinjam</i>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </a>
                </x-content.card>
            @empty
            @endforelse
        </div>
    </div>
</x-app-layout>
