<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Loans') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    {{-- <a href="{{ route('book-category.create') }}">
                        <x-primary-button class="mb-3">
                            Add Book category
                        </x-primary-button>
                    </a> --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Book
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Borrow Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Return Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fine Amount
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Action
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($loans as $loan)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $no++ }}</td>
                                        <td class="px-6 py-4">{{ $loan->user_id }}</td>
                                        <td class="px-6 py-4">{{ $loan->book_id }}</td>
                                        <td class="px-6 py-4">{{ $loan->borrow_date }}</td>
                                        <td class="px-6 py-4">{{ $loan->return_date ?: '-' }}</td>
                                        <td class="px-6 py-4">{{ $loan->fine_amount }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('loan.return', $loan->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('PUT')
                                                <x-button variant="primary" type="submit">
                                                    <i class="fa-sharp fa-solid fa-claim"></i>
                                                </x-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center">No data</td>
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
