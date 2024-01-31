<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('dashboard.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookCategory = BookCategory::all();
        return view('dashboard.book.create', compact('bookCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        $book = Book::all();
        dd($request->title);
        //validate form
        $this->validate($request, [
            'book_code' => 'required|unique:books,book_code,' . $book->id,
            'title' => 'required|max:225',
            'author' => 'required',
            'publish_date' => 'nullable',
            'stock' => 'integer',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'book_category_id' => 'nullable|exists:book_categories,id',
        ]);
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/book/', $image->hashName());
        //create post
        Book::create([
            'book_code' => $request->book_code,
            'title' => $request->title,
            'author' => $request->author,
            'publish_date' => $request->publish_date,
            'stock' => $request->stock,
            'image' => $image->hashName(),
            'book_category_id' => $request->book_category_id,
        ]);

        //redirect to index
            return redirect()->route('book.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $bookCategory = BookCategory::all();
        return view('dashboard.book.show', compact('book', 'bookCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $bookCategory = BookCategory::all();
        return view('dashboard.book.edit', compact('book','bookCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //validate form
        $this->validate($request, [
            'book_code' => 'required|unique:books,book_code,' . $book->id,
            'title' => 'required|max:225',
            'author' => 'required',
            'publish_date' => 'nullable',
            'stock' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'book_category_id' => 'nullable|exists:book_categories,id',
        ]);


        if($request->hasFile('image')){

            $image = $request->file('image');
            $image->storeAs('public/book/', $image->hashName());

            Storage::delete('public/book/', $book->image);

            $book->update([
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publish_date' => $request->publish_date,
                'stock' => $request->stock,
                'image' => $image->hashName(),
                'book_category_id' => $request->book_category_id,
            ]);
          }else {

            $book->update([
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publish_date' => $request->publish_date,
                'stock' => $request->stock,
                'book_category_id' => $request->book_category_id,
            ]);
          }
          return redirect()->route('book.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        $old_image = $book->image;
        $book->delete();
        if(!empty($old_image) && (Storage::disk('public'))->exists($old_image)){
            Storage::disk('public')->delete($old_image);
        }
        return to_route('book.index');
    }
}
