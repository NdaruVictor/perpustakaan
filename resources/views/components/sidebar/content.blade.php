<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="Books" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'buttons',
    )">
        <x-slot name="icon">
            <i class="fa-solid fa-book mx-1"></i>
        </x-slot>
        <x-sidebar.sublink title="Book" href="{{ route('book.index') }}" :active="request()->routeIs('')" />
        <x-sidebar.sublink title="BookCategory" href="{{ route('book-categories.index') }}" :active="request()->routeIs('book-category.index')" />
    </x-sidebar.dropdown>

    <x-sidebar.link title="Loans" href="{{ route('loans.index') }}" :isActive="request()->routeIs('loan.index')">
        <x-slot name="icon">
            <i class="fa-solid fa-list mx-1"></i>
        </x-slot>
    </x-sidebar.link>

</x-perfect-scrollbar>
