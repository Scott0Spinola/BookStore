@extends('layouts.bookstore')

@section('title', 'Purchase Confirmation')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h2 class="mb-0">
                        <i class="fas fa-check-circle"></i> Purchase Successful!
                    </h2>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <p class="lead">Thank you for your purchase!</p>
                        <p class="text-muted">Your order has been confirmed.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img src="{{ $sale->book->image_url ?? 'https://via.placeholder.com/200' }}" 
                                 alt="{{ $sale->book->title }}" 
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 250px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">Purchase Details</h4>
                            
                            <div class="mb-3">
                                <strong>Book:</strong>
                                <p class="mb-1">{{ $sale->book->title }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Category:</strong>
                                <p class="mb-1">{{ $sale->book->category->name }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Price:</strong>
                                <p class="mb-1 h5 text-success">${{ number_format($sale->book->price, 2) }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Purchase Date:</strong>
                                <p class="mb-1">{{ $sale->sale_date->format('F d, Y g:i A') }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Order ID:</strong>
                                <p class="mb-1">#{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('sales.index') }}" class="btn btn-primary me-2">
                            <i class="fas fa-list"></i> View My Purchases
                        </a>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-book"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    border: none;
}
.card-header {
    padding: 1.5rem;
}
.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
}
</style>
@endpush
