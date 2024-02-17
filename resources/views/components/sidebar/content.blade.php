<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">
    @guest
        <!-- Tampilkan navigasi untuk pengguna yang belum login -->
        <x-sidebar.link title="Dashboard" href="{{ route('landing') }}" :isActive="request()->routeIs('dashboard')">
            <x-slot name="icon">
                <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Buku" href="{{ route('books.index') }}" :isActive="request()->routeIs('books.index')">
            <x-slot name="icon">
                <i class="fa-solid fa-book mx-1"></i>
            </x-slot>
        </x-sidebar.link>
        {{-- <x-sidebar.link title="About" href="{{ route('about') }}" :isActive="request()->routeIs('about')" /> --}}
        <!-- Tambahkan link lain yang diperlukan untuk pengguna belum login -->
    @else
        <!-- Tampilkan navigasi untuk pengguna yang sudah login -->
        @if(auth()->user()->hasRole(['admin', 'petugas']))
            <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
                <x-slot name="icon">
                    <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>
            </x-sidebar.link>

            <x-sidebar.dropdown title="Buku" :active="Str::startsWith(
                request()
                    ->route()
                    ->uri(),
                'buttons',
            )">
                <x-slot name="icon">
                    <i class="fa-solid fa-book mx-1"></i>
                </x-slot>
                <x-sidebar.sublink title="Buku" href="{{ route('book.index') }}" :active="request()->routeIs('')" />
                <x-sidebar.sublink title="Kategori Buku" href="{{ route('book-categories.index') }}" :active="request()->routeIs('book-category.index')" />
            </x-sidebar.dropdown>

            <x-sidebar.link title="Peminjaman" href="{{ route('loans.index') }}" :isActive="request()->routeIs('loan.index')">
                <x-slot name="icon">
                    <i class="fa-solid fa-list mx-1"></i>
                </x-slot>
            </x-sidebar.link>
            <x-sidebar.link title="Pengguna" href="{{ route('users.index') }}" :isActive="request()->routeIs('users.index')">
                <x-slot name="icon">
                    <i class="fa-solid fa-user mx-1"></i>
                </x-slot>
            </x-sidebar.link>
            @elseif(auth()->user()->hasRole(['pengguna']))
            <x-sidebar.link title="Dashboard" href="{{ route('landing') }}" :isActive="request()->routeIs('dashboard')">
                <x-slot name="icon">
                    <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>
            </x-sidebar.link>
            <x-sidebar.link title="Buku" href="{{ route('books.index') }}" :isActive="request()->routeIs('books.index')">
                <x-slot name="icon">
                    <i class="fa-solid fa-book mx-1"></i>
                </x-slot>
            </x-sidebar.link>
            <x-sidebar.link title="Peminjaman" href="{{ route('loans.index') }}" :isActive="request()->routeIs('loan.index')">
                <x-slot name="icon">
                    <i class="fa-solid fa-list mx-1"></i>
                </x-slot>
            </x-sidebar.link>

        @endif
    @endguest
</x-perfect-scrollbar>
