@extends('layouts.bookstore')

@section('title', "Books in {$category->name}")

@section('content')
    <div class="container">
        <h1>Books in {{ $category->name }}</h1>

        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-4 col-lg-3 mb-4">
                    <x-book-card :book="$book" />
                </div>
            @empty
                <div class="col">
                    <p>No books found in this category.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
@endsection

@push('styles')
<style>
.row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
}
</style>
@endpush
