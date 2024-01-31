<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $bookcategories = BookCategory::all();
        return view('dashboard.bookcategory.index', compact('bookcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.bookcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
        ]);
        //create a new
        BookCategory::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
      //redirect to index
            return redirect()->route('book-categories.index')->with(['success' => 'Data
            Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id): View
    {
        $bookcategory = BookCategory::findOrFail($id);
        return view('dashboard.bookcategory.show', compact('bookcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id): View
    {
        $bookcategory = BookCategory::findOrFail($id);
        return view('dashboard.bookcategory.edit', compact('bookcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookCategory $bookCategory)
    {
        //validate form
        $this->validate($request, [
            'name' => 'nullable',
            'description' => 'nullable',
        ]);
        //update data
        $bookCategory->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
      //redirect to index
            return redirect()->route('book-categories.index')->with(['success' => 'Data
            Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookCategory $bookCategory)
    {
         // Delete the category
         $bookCategory->books()->delete();
         $bookCategory->delete();
         // Redirect to the index page with a success message
         return redirect()->route('book-categories.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
