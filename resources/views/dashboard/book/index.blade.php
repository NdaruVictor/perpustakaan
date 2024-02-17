<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Buku') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                        <a href="{{ route('book.create') }}">
                            <x-primary-button class="mb-3">
                                Tambah Buku
                            </x-primary-button>
                        </a>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Gambar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Judul
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Penulis
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Tahun
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Stok
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($books as $book)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $no++ }}</td>
                                        <td class="border px-6 py-4 flex justify-center items-center"><img
                                                src="{{ asset('storage/book/' . $book->image) }}" class="w-32 m-3"></td>
                                        <td class="px-6 py-4">{{ $book->title }}</td>
                                        <td class="px-6 py-4">{{ $book->author }}</td>
                                        <td class="px-6 py-4">{{ $book->publish_date }}</td>
                                        <td class="px-6 py-4">{{ $book->stock }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('book.destroy', $book->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin?')">
                                                <x-button variant="warning" href="{{ route('book.edit', $book->id) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </x-button>
                                                <x-button variant="info" href="{{ route('book.show', $book->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </x-button>
                                                @csrf
                                                @method('DELETE')
                                                <x-button variant="danger" type="submit">
                                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                                </x-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
