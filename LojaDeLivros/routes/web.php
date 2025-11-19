<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Sales routes - protected by auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/my-purchases', [SaleController::class, 'index'])->name('sales.index');
    Route::post('/books/{book}/purchase', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/purchases/{sale}/confirmation', [SaleController::class, 'confirmation'])->name('sales.confirmation');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('books', \App\Http\Controllers\Admin\BookController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});


require __DIR__.'/auth.php';
