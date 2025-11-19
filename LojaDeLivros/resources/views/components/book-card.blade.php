@props(['book'])

<div class="card book-card h-100">
    <a href="{{ route('books.show', $book) }}">
        <img src="{{ $book->image_url ?? 'https://via.placeholder.com/150' }}" class="card-img-top" alt="{{ $book->title }}">
    </a>
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $book->title }}</h5>
        <p class="card-text text-muted">{{ $book->category->name }}</p>
        <p class="card-text font-weight-bold mt-auto">${{ number_format($book->price, 2) }}</p>
    </div>
</div>

@push('styles')
<style>
.book-card img {
    height: 200px;
    object-fit: cover;
}
.book-card .card-body {
    display: flex;
    flex-direction: column;
}
.book-card .card-title {
    font-size: 1.1rem;
    font-weight: 600;
}
</style>
@endpush
