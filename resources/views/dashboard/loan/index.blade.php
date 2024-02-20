<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Peminjaman') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    @if (auth()->user()->hasRole(['admin|petugas']))
                    <div class="mb-4 flex flex-wrap gap-2">
                        <div>
                            <form action="{{ route('loans.index') }}" method="GET">
                                <div class="flex flex-wrap gap-4">
                                    <div>
                                        <x-form.label for="start_date" :value="__('Start Date')" class="font-semibold" />
                                        <x-form.input type="date" name="start_date" id="start_date"
                                            value="{{ request()->input('start_date') }}" class="block w-full" />
                                    </div>
                                    <div>
                                        <x-form.label for="end_date" :value="__('End Date')" class="font-semibold" />
                                        <x-form.input type="date" name="end_date" id="end_date"
                                            value="{{ request()->input('end_date') }}" class="block w-full" />
                                    </div>
                                    <div class="mt-6">
                                        <x-button variant="warning">
                                            <i class="fa-sharp fa-solid fa-filter"></i>
                                        </x-button>
                                        <x-button variant="danger" href="{{ route('loans.index') }}">
                                            <i class="fa-sharp fa-solid fa-rotate"></i>
                                        </x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-6">
                            <form action="{{ route('loan.generatePdfByFilter') }}" method="GET">
                                @if(request()->has('start_date') && request()->has('end_date'))
                                    <input type="hidden" name="start_date" value="{{ request()->start_date }}">
                                    <input type="hidden" name="end_date" value="{{ request()->end_date }}">
                                @endif
                                <x-button variant="primary" type="submit">
                                    <i class="text-xs">Buat Laporan</i>
                                </x-button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">No</th>
                                    <th scope="col" class="px-6 py-3 text-center">Pengguna</th>
                                    <th scope="col" class="px-6 py-3 text-center">Buku</th>
                                    <th scope="col" class="px-6 py-3 text-center">Tanggal Pinjam</th>
                                    <th scope="col" class="px-6 py-3 text-center">Tanggal Kembali</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jumlah Denda</th>
                                    @if (auth()->user()->hasRole(['admin|petugas']))
                                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($loans as $loan)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $no++ }}</td>
                                        <td class="px-6 py-4">{{ $loan->user->name }}</td>
                                        <td class="px-6 py-4">{{ $loan->book->title }}</td>
                                        <td class="px-6 py-4">
                                            {{ \Carbon\Carbon::parse($loan->borrow_date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $loan->return_date? \Carbon\Carbon::parse($loan->return_date)->locale('id_ID')->isoFormat('D MMMM YYYY'): '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ 'Rp ' . number_format($loan->fine_amount, 0, ',', '.') }}</td>
                                        @if (auth()->user()->hasRole(['admin|petugas']))
                                            <td class="px-6 py-4 flex gap-2">
                                                <form action="{{ route('loan.return', $loan->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-button variant="primary" type="submit">
                                                        <i class="text-xs">Kembalikan Buku</i>
                                                    </x-button>
                                                </form>
                                                <form action="{{ route('loan.generatePdf', $loan->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('GET')
                                                    <x-button variant="primary" type="submit">
                                                        <i class="text-xs">Buat Laporan</i>
                                                    </x-button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center">Tidak Ada Data</td>
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
