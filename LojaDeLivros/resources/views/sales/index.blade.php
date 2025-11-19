@extends('layouts.bookstore')

@section('title', 'My Purchases')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">
                <i class="fas fa-shopping-bag"></i> My Purchases
            </h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($sales->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Book</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Purchase Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td class="align-middle">
                                                <strong>#{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</strong>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $sale->book->image_url ?? 'https://via.placeholder.com/50' }}" 
                                                         alt="{{ $sale->book->title }}" 
                                                         class="rounded me-3"
                                                         style="width: 50px; height: 70px; object-fit: cover;">
                                                    <div>
                                                        <strong>{{ $sale->book->title }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge bg-info text-dark">
                                                    {{ $sale->book->category->name }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <strong class="text-success">${{ number_format($sale->book->price, 2) }}</strong>
                                            </td>
                                            <td class="align-middle">
                                                {{ $sale->sale_date->format('M d, Y') }}
                                                <br>
                                                <small class="text-muted">{{ $sale->sale_date->format('g:i A') }}</small>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('books.show', $sale->book) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> View Book
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $sales->links() }}
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-bag fa-4x text-muted mb-3"></i>
                        <h3 class="text-muted">No Purchases Yet</h3>
                        <p class="text-muted mb-4">You haven't purchased any books yet. Start exploring our collection!</p>
                        <a href="{{ route('books.index') }}" class="btn btn-primary">
                            <i class="fas fa-book"></i> Browse Books
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}
.card {
    border: none;
}
.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
}
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.025);
}
</style>
@endpush
