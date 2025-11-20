@extends('layouts.bookstore')

@section('title', 'All Books')

@section('content')
    <!-- Random Book Spotlight -->
    @if($randomBook)
    <div class="random-book-spotlight">
        <div class="spotlight-content">
            <div class="spotlight-image">
                <img src="{{ $randomBook->image_url ?? 'https://via.placeholder.com/200x300/FF6B35/FFFFFF?text=' . urlencode($randomBook->title) }}" alt="{{ $randomBook->title }}">
            </div>
            <div class="spotlight-info">
                <h3>Book of the Day</h3>
                <h2>{{ $randomBook->title }}</h2>
                <p class="spotlight-author">by {{ $randomBook->author }}</p>
                @if($randomBook->category)
                    <span class="spotlight-category">{{ $randomBook->category->name }}</span>
                @endif
                <p class="spotlight-description">{{ Str::limit($randomBook->description ?? 'Discover this amazing book in our collection.', 150) }}</p>
                <div class="spotlight-price">${{ number_format($randomBook->price, 2) }}</div>
                <a href="{{ route('books.show', $randomBook) }}" class="spotlight-button">View Details</a>
            </div>
        </div>
    </div>
    @endif

    <!-- Section Header -->
    <div class="section-header">
        <h2>Featured Books</h2>
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
    /* Random Book Spotlight */
    .random-book-spotlight {
        background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
        border-radius: 12px;
        margin-bottom: 3rem;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(232, 93, 23, 0.3);
    }

    .spotlight-content {
        display: flex;
        align-items: center;
        gap: 2rem;
        padding: 2rem;
        color: var(--white);
    }

    .spotlight-image {
        flex-shrink: 0;
        width: 180px;
        height: 270px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .spotlight-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .spotlight-info {
        flex: 1;
        min-width: 0;
    }

    .spotlight-info h3 {
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }

    .spotlight-info h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.75rem;
        line-height: 1.2;
    }

    .spotlight-author {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .spotlight-category {
        background-color: rgba(255, 255, 255, 0.2);
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .spotlight-description {
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        opacity: 0.95;
    }

    .spotlight-price {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }

    .spotlight-button {
        background-color: var(--white);
        color: var(--primary-orange);
        padding: 0.75rem 2rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .spotlight-button:hover {
        background-color: #f8f8f8;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    /* Responsive design for spotlight */
    @media (max-width: 768px) {
        .spotlight-content {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }

        .spotlight-image {
            width: 150px;
            height: 225px;
            margin: 0 auto;
        }

        .spotlight-info h2 {
            font-size: 1.5rem;
        }

        .spotlight-price {
            font-size: 1.5rem;
        }
    }

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
