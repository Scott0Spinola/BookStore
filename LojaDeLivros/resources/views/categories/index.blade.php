@extends('layouts.bookstore')

@section('title', 'All Categories')

@section('content')
    <div class="container">
        <h1>All Categories</h1>

        <div class="list-group">
            @forelse ($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="list-group-item list-group-item-action">
                    {{ $category->name }}
                </a>
            @empty
                <p>No categories found.</p>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
<style>
.list-group-item {
    font-size: 1.2rem;
    padding: 1rem 1.5rem;
}
</style>
@endpush
