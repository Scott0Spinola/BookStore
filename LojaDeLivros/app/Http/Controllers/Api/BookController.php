<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('category')->get();
    }

    public function show($id)
    {
        return Book::with('category')->findOrFail($id);
    }
}
