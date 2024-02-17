<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    @if(auth()->user()->hasRole(['admin']))
                    <a href="{{ route('users.create') }}">
                        <x-primary-button class="mb-3">
                            Tambah Pengguna
                        </x-primary-button>
                    </a>
                    @endif
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Peran
                                    </th>
                                    @if(auth()->user()->hasRole(['admin']))
                                    <th scope="col" class="px-6 py-3">
                                        aksi
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $no++ }}</td>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">
                                            @foreach ($user->roles as $role)
                                                @if ($role->name == 'admin')
                                                    <span
                                                        class="bg-green-500 text-white  font-semibold rounded px-1 py-0.5">{{ $role->name }}</span>
                                                @elseif ($role->name == 'petugas')
                                                    <span
                                                        class="bg-cyan-500 text-white  font-semibold rounded px-1 py-0.5">{{ $role->name }}</span>
                                                @else
                                                    <span
                                                        class="bg-blue-500 text-white  font-semibold rounded px-1 py-0.5">{{ $role->name }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @if(auth()->user()->hasRole(['admin']))
                                        <td class="px-6 py-4">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                                <x-button variant="warning" href="{{ route('users.edit', $user->id) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </x-button>
                                                <x-button variant="info" href="{{ route('users.show', $user->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </x-button>
                                                @csrf
                                                @method('DELETE')
                                                <x-button variant="danger" type="submit">
                                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                                </x-button>
                                            </form>
                                        </td>
                                    @endif
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
