<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the user's purchases.
     */
    public function index()
    {
        $sales = Sale::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('sale_date', 'desc')
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    /**
     * Store a newly created purchase in storage.
     */
    public function store(Request $request, Book $book)
    {
        // Check if user already purchased this book
        $existingPurchase = Sale::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($existingPurchase) {
            return redirect()->back()->with('error', 'You have already purchased this book.');
        }

        // Create the sale
        $sale = Sale::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'sale_date' => now(),
        ]);

        return redirect()->route('sales.confirmation', $sale)
            ->with('success', 'Book purchased successfully!');
    }

    /**
     * Display the purchase confirmation page.
     */
    public function confirmation(Sale $sale)
    {
        // Ensure the user can only view their own purchases
        if ($sale->user_id !== Auth::id()) {
            abort(403);
        }

        $sale->load('book');

        return view('sales.confirmation', compact('sale'));
    }
}
