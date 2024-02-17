<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("Anda telah masuk!")  }}
    </div>

    <div class="flex">
        <div class="p-6 mt-5 w-1/3 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 m-2">
            <a class="flex" href="{{ route('book.index') }}">
                <div class="items-center text-center">
                    <div class="bg-orange-200 rounded-md">
                        <i class="fa-solid fa-book text-xl px-5 py-4"></i>
                    </div>

                    <p class="pt-3 text-xl">{{ $bookCount }}</p>
                </div>
                <div class="text-2xl">
                    <p class="pt-4 pl-6">buku</p>
                </div>
            </a>
        </div>
        <div class="p-6 mt-5 w-1/3 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 m-2">
            <a class="flex" href="{{ route('book-categories.index') }}">
                <div class="items-center text-center">
                    <div class="bg-orange-200 rounded-md">
                        <i class="fa-solid fa-bars text-xl px-5 py-4"></i>
                    </div>

                    <p class="pt-3 text-xl">{{ $categoryCount }}</p>
                </div>
                <div class="text-2xl">
                    <p class="pt-4 pl-6">Kategori buku</p>
                </div>
            </a>
        </div>
        @if (auth()->user()->hasRole(['admin|petugas']))
            <div class="p-6 mt-5 w-1/3 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 m-2">
                <a class="flex">
                    <div class="items-center text-center">
                        <div class="bg-orange-200 rounded-md">
                            <i class="fa-solid fa-user text-xl px-5 py-4"></i>
                        </div>

                        <p class="pt-3 text-xl">{{ $userCount }}</p>
                    </div>
                    <div class="text-2xl">
                        <p class="pt-4 pl-6">Pengguna</p>
                    </div>
                </a>
            </div>
            <div class="p-6 mt-5 w-1/3 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 m-2">
                <a class="flex" href="{{ route('loans.index') }}">
                    <div class="items-center text-center">
                        <div class="bg-orange-200 rounded-md">
                            <i class="fa-solid fa-list text-xl px-5 py-4"></i>
                        </div>
                        <p class="pt-3 text-xl">{{ $loanCount }}</p>
                    </div>
                    <div class="text-2xl">
                        <p class="pt-4 pl-6">Peminjaman</p>
                    </div>
                </a>
            </div>
        @endif
    </div>

</x-app-layout>
