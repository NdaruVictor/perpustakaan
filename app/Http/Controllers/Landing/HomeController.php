<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
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
        // dd($book);
        // Pass all the variables to the view
        return view('landing.dashboard', compact('bookCount', 'categoryCount', 'userCount', 'loanCount'));
    }
}
