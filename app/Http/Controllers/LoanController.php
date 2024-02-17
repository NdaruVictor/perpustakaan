<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::user()->hasRole(['admin', 'petugas'])) {
            $loans = Loan::with(['user', 'book'])->get();
        } else {
            $user = Auth::user();
            $loans = $user->loans()->with(['user', 'book'])->get();
        }

        return view('dashboard.loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = Auth::user();
        $users = User::where('id', $user->id)->get();
        $book = Book::findOrFail($id);
        $lastLoan = $user->loans()->latest()->first();
        return view('dashboard.loan.create', compact('book', 'users', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'manual_stock' => 'nullable|boolean',
            'quantity' => 'nullable|integer',
        ]);

        $borrowDate = Carbon::now();
        $returnDate = null; // Buku belum dikembalikan

        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $borrowDate,
            'return_date' => $returnDate,
            'fine_amount' => 0,
        ]);

        // Update stok buku
        if($request->input('mabual_stock', false)){
            $quantity = $request->input('quantity', 1);
            $book = Book::findOrFail($request->book_id);
            $book->decrement('stock', $quantity); // Kurangi stok buku
        }
        // Logika lain seperti mengurangi stok buku, dll. bisa ditambahkan di sini.

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dipinjam!');
    }

    public function returnBook(Request $request, $id)
{
    $loan = Loan::findOrFail($id);

    // Validasi apakah buku sudah dikembalikan sebelumnya
    if ($loan->return_date !== null) {
        return redirect()->route('loans.index')->with('error', 'Buku sudah dikembalikan sebelumnya!');
    }

    $returnDate = Carbon::now(); // Mengatur tanggal pengembalian saat ini

    $loan->update(['return_date' => $returnDate]);

    // Hitung jumlah hari keterlambatan
    $borrowDate = Carbon::parse($loan->borrow_date);
    $daysLate = $returnDate->diffInDays($borrowDate) - 6;

    if ($daysLate > 0) {
        //tarif denda per hari
        $fineRatePerDay = 5000;

        // Hitung total denda
        $fineAmount = $fineRatePerDay * $daysLate;

        // Simpan jumlah denda ke dalam database
        $loan->update(['fine_amount' => $fineAmount]);
    }

    // Update stok buku saat buku dikembalikan
    $book = Book::findOrFail($loan->book_id);
    $book->increment('stock'); // Tambahkan stok buku

    // Logika lain seperti menambah stok buku, dll. bisa ditambahkan di sini.

    return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan!');
}


    public function generatePdf($id) {

        // Temukan peminjaman berdasarkan ID
        $loan = Loan::with(['user', 'book'])->findOrFail($id);
        // Buat instansi PDF
        $pdf = PDF::loadView('dashboard.loan.generate', compact('loan'));
        // Atur opsi ukuran kertas dan orientasi (opsional)
        $pdf->setPaper('A4', 'portrait');
        // Unduh berkas PDF
        return $pdf->stream('peminjaman_' . $loan->id . '.pdf');

    }
}
