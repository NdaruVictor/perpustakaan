<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">Pengguna</th>
                <th scope="col" class="px-6 py-3 text-center">Buku</th>
                <th scope="col" class="px-6 py-3 text-center">Tanggal Pinjam</th>
                <th scope="col" class="px-6 py-3 text-center">Tanggal Kembali</th>
                <th scope="col" class="px-6 py-3 text-center">Jumlah Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
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
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
