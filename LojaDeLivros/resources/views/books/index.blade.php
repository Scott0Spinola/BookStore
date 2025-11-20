@extends('layouts.bookstore')

@section('title', 'All Books')

@section('content')
    <!-- Section Header -->
    <div class="section-header">
        <h2>New Releases You Can't Miss</h2>
        <a href="#">VIEW ALL +</a>
    </div>

    <!-- Filter and Sort Bar -->
    <div class="filter-bar">
        <form action="{{ route('books.index') }}" method="GET" class="filter-form">
            <select name="sort" class="filter-select">
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Sort by Title</option>
                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Sort by Price</option>
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Sort by Newest</option>
            </select>
            <select name="direction" class="filter-select">
                <option value="asc" {{ request('direction', 'asc') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('direction', 'asc') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
            <button type="submit" class="filter-button">
                <i class="fas fa-filter"></i> Apply Filters
            </button>
        </form>
    </div>

    <!-- Books Grid -->
    <div class="books-grid">
        @forelse ($books as $book)
            <x-book-card :book="$book" />
        @empty
            <div class="no-books">
                <p>No books found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($books->hasPages())
        <div class="pagination-container">
            {{ $books->appends(request()->query())->links() }}
        </div>
    @endif
@endsection

@push('styles')
<style>
    .filter-bar {
        background-color: var(--white);
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .filter-form {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-select {
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-gray);
        border-radius: 4px;
        font-size: 0.95rem;
        background-color: var(--white);
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-orange);
    }

    .filter-button {
        padding: 0.75rem 1.5rem;
        background-color: var(--primary-orange);
        color: var(--white);
        border: none;
        border-radius: 4px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-button:hover {
        background-color: var(--secondary-orange);
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .no-books {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem;
        background-color: var(--white);
        border-radius: 8px;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        padding: 2rem 0;
    }

    @media (max-width: 768px) {
        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
        }

        .filter-form {
            flex-direction: column;
            width: 100%;
        }

        .filter-select,
        .filter-button {
            width: 100%;
        }
    }
</style>
@endpush
