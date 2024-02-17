<?php

use App\Http\Controllers\BookUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Landing\HomeController::class, 'index'])->name('landing');

//penguna
Route::middleware(['auth', 'role:pengguna'])->group(function () {
    Route::resource('/loans', 'LoanController')->only('store');
    Route::get('/loans/create/{id}', 'LoanController@create')->name('loan.create');
});

//admin | petugas
Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::put('/users/{id}/edit', [UserController::class, 'update'])->name('users.update');
    Route::resource('/users', 'UserController');
    Route::resource('/book', 'BookController');
    Route::put('/loans/{id}/return', 'LoanController@returnBook')->name('loan.return');
    Route::get('/loans-genarate/{id}', 'LoanController@generatePdf')->name('loan.generatePdf');
    Route::resource('/book-categories', 'BookCategoryController');
});

Route::get('/books', 'Landing\BookController@index')->name('books.index');
Route::get('/books/{id}', 'Landing\BookController@show')->name('books.show');
Route::get('/keyword', 'Landing\BookController@keyword')->name('books.keyword');


Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'role:admin|petugas'])->name('dashboard');

// Rute untuk yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/loans', 'LoanController')->only('index');
});

require __DIR__ . '/auth.php';
