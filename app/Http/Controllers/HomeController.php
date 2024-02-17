<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function index( )
    {
        $bookCount = Book::count();
        $categoryCount = BookCategory::count();
        $userCount = User::count();
        $loanCount = Loan::count();
        // Pass all the variables to the view
        return view('dashboard', compact('bookCount', 'categoryCount', 'userCount', 'loanCount'));
    }
}
