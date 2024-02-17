<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Buku') }}
            </h2>
        </div>
    </x-slot>

    <div class="h-3/4 rounded-lg bg-white shadow-lg mt-10">
        <div class="flex flex-wrap items-center">
            <div class="w-full shrink-0 grow-0 basis-auto lg:flex lg:w-6/12 xl:w-4/12 p-5">
                <img src="{{ asset('storage/book/' . $book->image) }}" alt="..."
                    class="container w-2/3 h-2/3 rounded-lg my-8" />
            </div>
            <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 xl:w-8/12">
                <div class="px-6 py-12 md:px-12">
                    <h2 class="mb-6 text-2xl font-bold text-center md:text-left text-black">
                        {{ $book->title }}
                    </h2>
                    <div class="">
                        <p class="text-gray-800 text-lg">
                            {{ $book->description }}
                        </p>
                    </div>
                    <div class="mt-5 flex gap-8">
                        <div>
                            <p class="text-gray-800 text-sm">Penulis : {{ $book->author}}</p>
                        </div>
                        <div>
                            <p class="text-gray-800 text-sm">Stok : {{ $book->stock}}</p>
                        </div>
                        <div>
                            <p class="text-gray-800 text-sm">Tanggal Rilis : {{ $book->publish_date}}</p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <x-button variant="danger" href="{{ route('books.index') }}">
                            <i class="text-xs">Kembali</i>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
