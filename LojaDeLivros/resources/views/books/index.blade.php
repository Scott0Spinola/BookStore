@extends('layouts.bookstore')

@section('title', 'All Books')

@section('content')
    <div class="container">
        <h1>All Books</h1>

        <!-- Search and Sort -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('books.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-3">
                        <input type="text" name="search" class="form-control" placeholder="Search by title or category..." value="{{ request('search') }}">
                    </div>
                    <div class="form-group mr-3">
                        <select name="sort" class="form-control">
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Sort by Title</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Sort by Price</option>
                        </select>
                    </div>
                    <div class="form-group mr-3">
                        <select name="direction" class="form-control">
                            <option value="asc" {{ request('direction', 'asc') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('direction', 'asc') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply</button>
                </form>
            </div>
        </div>

        <!-- Books Grid -->
        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-4 col-lg-3 mb-4">
                    <x-book-card :book="$book" />
                </div>
            @empty
                <div class="col">
                    <p>No books found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $books->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@push('styles')
<style>
    .form-inline {
        display: flex;
        gap: 1rem;
    }
    .row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
</style>
@endpush
