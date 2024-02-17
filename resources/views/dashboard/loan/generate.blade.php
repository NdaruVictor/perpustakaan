<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pinjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Laporan Pinjaman</h1>
        <div class="flex flex-col space-y-2">
            <div>
                <span class="font-bold">Pengguna:</span> {{ $loan->user->name }}
            </div>
            <div>
                <span class="font-bold">Buku:</span> {{ $loan->book->title }}
            </div>
            <div>
                <span class="font-bold">Tanggal Pinjam:</span> {{ \Carbon\Carbon::parse($loan->borrow_date)->translatedFormat('l, j F Y') }}
            </div>
            <div>
                <span class="font-bold">Tanggal Kembali:</span> {{ \Carbon\Carbon::parse($loan->return_date)->translatedFormat('l, j F Y') }}
            </div>
            <div>
                <span class="font-bold">Jumlah Denda:</span> Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}
            </div>
        </div>
    </div>
</body>
</html>
