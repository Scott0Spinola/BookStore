@props(['book'])

<div class="book-card">
    <div class="book-image-container">
        <a href="{{ route('books.show', $book) }}">
            <img src="{{ $book->image_url ?? 'https://via.placeholder.com/200x300/FF6B35/FFFFFF?text=' . urlencode($book->title) }}" alt="{{ $book->title }}">
        </a>
    </div>
    
    <div class="book-info">
        <span class="book-badge">FREE SHIPPING</span>
        
        <div class="book-price">
            <span class="price">${{ number_format($book->price, 2) }}</span>
        </div>
        
        <h3 class="book-title">
            <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
        </h3>
        
        <p class="book-author">by {{ $book->author }}</p>
        
        @if($book->category)
            <p class="book-category">{{ $book->category->name }}</p>
        @endif
        
        <div class="book-rating">
            @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star"></i>
            @endfor
            <span>({{ rand(1, 100) }})</span>
        </div>
    </div>
</div>

@push('styles')
<style>
.book-card {
    background-color: var(--white);
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}

.book-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.book-image-container {
    position: relative;
    overflow: hidden;
    padding-top: 150%; /* 2:3 aspect ratio for book covers */
    background-color: #f9f9f9;
}

.book-image-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.book-card:hover .book-image-container img {
    transform: scale(1.05);
}



.book-info {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    flex: 1;
}

.book-badge {
    background-color: #27AE60;
    color: var(--white);
    padding: 0.3rem 0.6rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
    align-self: flex-start;
}

.book-price {
    margin-top: 0.25rem;
}

.price {
    color: var(--primary-orange);
    font-weight: bold;
    font-size: 1.25rem;
}

.book-title {
    font-size: 1rem;
    margin: 0.5rem 0 0.25rem;
    line-height: 1.3;
}

.book-title a {
    color: var(--text-dark);
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.book-title a:hover {
    color: var(--primary-orange);
}

.book-author {
    font-size: 0.85rem;
    color: var(--text-gray);
    margin: 0;
}

.book-category {
    font-size: 0.8rem;
    color: var(--text-gray);
    margin: 0;
}

.book-rating {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin-top: 0.5rem;
}

.book-rating i {
    color: #F39C12;
    font-size: 0.85rem;
}

.book-rating span {
    font-size: 0.8rem;
    color: var(--text-gray);
    margin-left: 0.25rem;
}
</style>
@endpush
