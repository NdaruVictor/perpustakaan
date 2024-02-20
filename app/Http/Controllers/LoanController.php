<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (Auth::user()->hasRole(['admin', 'petugas'])) {
            $query = Loan::with(['user', 'book']);
        } else {
            $user = Auth::user();
            $query = $user->loans()->with(['user', 'book']);
        }

        if ($startDate && $endDate) {
            // If both start date and end date are provided, filter loans within the date range
            $query->whereBetween(DB::raw('DATE(borrow_date)'), [$startDate, $endDate]);
        } elseif ($startDate) {
            // If only start date is provided, filter loans after start date
            $query->where(DB::raw('DATE(borrow_date)'), '>=', $startDate);
        } elseif ($endDate) {
            // If only end date is provided, filter loans before end date
            $query->where(DB::raw('DATE(borrow_date)'), '<=', $endDate);
        }

        $loans = $query->get();

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
            'quantity' => 'required|integer|min:1', // Validasi untuk jumlah buku yang diminta
        ]);

        $borrowDate = Carbon::now();
        $returnDate = null; // Buku belum dikembalikan

        // Mengambil informasi buku yang dipinjam
        $book = Book::findOrFail($request->book_id);

        // Validasi apakah jumlah buku yang diminta tidak melebihi stok yang tersedia
        if ($request->quantity > $book->stock) {
            return redirect()->back()->with('error', 'Jumlah buku yang diminta melebihi stok yang tersedia.');
        }

        // Buat peminjaman setelah mengurangi stok buku
        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity, // Simpan jumlah buku yang dipinjam
            'borrow_date' => $borrowDate,
            'return_date' => $returnDate,
            'fine_amount' => 0,
        ]);

        // Kurangi stok buku sesuai dengan jumlah yang dipinjam
        $book->decrement('stock', $request->quantity);

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
        $book->increment('stock', $loan->quantity); // Kembalikan stok buku sesuai dengan jumlah yang dipinjam

        // Logika lain seperti menambah stok buku, dll. bisa ditambahkan di sini.

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan!');
    }




    public function generatePdf($id)
    {

        // Temukan peminjaman berdasarkan ID
        $loan = Loan::with(['user', 'book'])->findOrFail($id);
        // Buat instansi PDF
        $pdf = PDF::loadView('dashboard.loan.generate', compact('loan'));
        // Atur opsi ukuran kertas dan orientasi (opsional)
        $pdf->setPaper('A4', 'portrait');
        // Unduh berkas PDF
        return $pdf->stream('peminjaman_' . $loan->id . '.pdf');
    }

    public function generatePdfByFilter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Mengambil peminjaman dalam rentang tanggal yang ditentukan
        $loansQuery = Loan::with(['user', 'book']);

        if ($startDate && $endDate) {
            // Jika kedua tanggal awal dan akhir disediakan, filter peminjaman dalam rentang tanggal
            $loansQuery->whereBetween(DB::raw('DATE(borrow_date)'), [$startDate, $endDate]);
        } elseif ($startDate) {
            // Jika hanya tanggal awal yang disediakan, filter peminjaman setelah tanggal awal
            $loansQuery->where(DB::raw('DATE(borrow_date)'), '>=', $startDate);
        } elseif ($endDate) {
            // Jika hanya tanggal akhir yang disediakan, filter peminjaman sebelum tanggal akhir
            $loansQuery->where(DB::raw('DATE(borrow_date)'), '<=', $endDate);
        }

        $loans = $loansQuery->get();

        // Membuat PDF dengan data peminjaman yang difilter
        $pdf = PDF::loadView('dashboard.loan.generateByFilter', compact('loans'));

        // Menetapkan ukuran kertas dan orientasi (opsional)
        $pdf->setPaper('A4', 'portrait');

        // Mengunduh PDF
        return $pdf->stream('filtered_loans.pdf');
    }
}
