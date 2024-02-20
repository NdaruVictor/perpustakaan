<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(8); 
        return view('landing.bookUser.index', compact('books'));
    }

    public function show($id){
        $book = Book::findOrfail($id);
        return view('landing.bookUser.show', compact('book'));
    }

    public function keyword(Request $request): View
    {
    $search = $request->input('search');

    $books = Book::where('title', 'like', '%' . $search . '%')
        ->paginate(5);

    return view('landing.bookUser.index', compact('books'));
    }
}
