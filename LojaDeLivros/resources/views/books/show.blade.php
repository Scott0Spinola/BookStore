@extends('layouts.bookstore')

@section('title', $book->title)

@section('content')
<div class="container">
    <div class="row">
        <!-- Book Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $book->image_url ?? 'https://via.placeholder.com/300' }}" class="img-fluid rounded-start" alt="{{ $book->title }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title">{{ $book->title }}</h1>
                            <p class="card-text"><small class="text-muted">Category: <a href="{{ route('categories.show', $book->category) }}">{{ $book->category->name }}</a></small></p>
                            <p class="card-text">{{ $book->description }}</p>
                            <p class="h4 font-weight-bold">${{ number_format($book->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books -->
    @if($relatedBooks->count() > 0)
    <div class="mt-5">
        <h2>Related Books</h2>
        <div class="row">
            @foreach ($relatedBooks as $relatedBook)
                <div class="col-md-4 col-lg-3 mb-4">
                    <x-book-card :book="$relatedBook" />
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.img-fluid {
    height: 100%;
    object-fit: cover;
}
.row {
    display: flex;
    flex-wrap: wrap;
}
.col-lg-8 {
    flex: 0 0 auto;
    width: 66.66666667%;
}
.g-0 {
    --bs-gutter-x: 0;
}
</style>
@endpush
