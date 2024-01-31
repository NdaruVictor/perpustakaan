<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with(['user', 'book'])->get();
        return view('dashboard.loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $users = User::all();
        $books = Book::all();
        return view('dashboard.loan.create', compact('books','users', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
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
        $book = Book::findOrFail($request->book_id);
        $book->decrement('stock'); // Kurangi stok buku

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


        $returnDate = Carbon::now();
        $loan->update(['return_date' => $returnDate]);

        // Update stok buku saat buku dikembalikan
        $book = Book::findOrFail($loan->book_id);
        $book->increment('stock'); // Tambahkan stok buku

        // Logika lain seperti menambah stok buku, dll. bisa ditambahkan di sini.

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan!');
    }
}
