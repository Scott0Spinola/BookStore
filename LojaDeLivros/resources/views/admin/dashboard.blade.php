<x-app-layout>
    <x-slot name="header">
        <div class="admin-dashboard-header">
            <h2 class="text-3xl font-bold mb-2">
                📚 Bookstore Admin Dashboard
            </h2>
            <p class="text-white/90">Welcome back! Manage your bookstore inventory and categories</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <h3>👋 Hello, {{ Auth::user()->name }}!</h3>
                <p>Here's your bookstore overview and quick actions</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Books -->
                <div class="stat-card">
                    <div class="stat-card-icon stat-card-books">
                        📖
                    </div>
                    <div class="stat-card-title">Total Books</div>
                    <div class="stat-card-value">{{ \App\Models\Book::count() }}</div>
                </div>

                <!-- Total Categories -->
                <div class="stat-card">
                    <div class="stat-card-icon stat-card-categories">
                        📂
                    </div>
                    <div class="stat-card-title">Categories</div>
                    <div class="stat-card-value">{{ \App\Models\Category::count() }}</div>
                </div>

                <!-- Total Users -->
                <div class="stat-card">
                    <div class="stat-card-icon stat-card-users">
                        👥
                    </div>
                    <div class="stat-card-title">Registered Users</div>
                    <div class="stat-card-value">{{ \App\Models\User::count() }}</div>
                </div>

                <!-- Books in Stock -->
                <div class="stat-card">
                    <div class="stat-card-icon stat-card-revenue">
                        📊
                    </div>
                    <div class="stat-card-title">Total Listings</div>
                    <div class="stat-card-value">{{ \App\Models\Book::count() }}</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions-grid">
                <!-- Manage Books -->
                <div class="action-card">
                    <div class="action-card-header">
                        <div class="action-card-icon-wrapper book-icon-animated">
                            📚
                        </div>
                        <h3 class="action-card-title">Manage Books</h3>
                    </div>
                    <p class="action-card-description">
                        View, add, edit, and delete books from your inventory. Keep your catalog up to date.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.books.index') }}" class="btn-bookstore btn-bookstore-primary">
                            📋 View All Books
                        </a>
                        <a href="{{ route('admin.books.create') }}" class="btn-bookstore btn-bookstore-success">
                            ➕ Add New Book
                        </a>
                    </div>
                </div>

                <!-- Manage Categories -->
                <div class="action-card">
                    <div class="action-card-header">
                        <div class="action-card-icon-wrapper">
                            🏷️
                        </div>
                        <h3 class="action-card-title">Manage Categories</h3>
                    </div>
                    <p class="action-card-description">
                        Organize your books into categories. Create, edit, and manage book classifications.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn-bookstore btn-bookstore-primary">
                            📋 View Categories
                        </a>
                        <a href="{{ route('admin.categories.create') }}" class="btn-bookstore btn-bookstore-success">
                            ➕ Add Category
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="action-card">
                    <div class="action-card-header">
                        <div class="action-card-icon-wrapper">
                            📈
                        </div>
                        <h3 class="action-card-title">Recent Updates</h3>
                    </div>
                    <p class="action-card-description">
                        Latest books added to your collection.
                    </p>
                    <div class="space-y-2">
                        @forelse(\App\Models\Book::latest()->take(3)->get() as $book)
                            <div class="activity-item">
                                <div class="text-sm font-semibold text-gray-800">{{ $book->title }}</div>
                                <div class="text-xs text-gray-600">{{ $book->author }}</div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 italic">No books added yet</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="action-card">
                    <div class="action-card-header">
                        <div class="action-card-icon-wrapper">
                            💰
                        </div>
                        <h3 class="action-card-title">Price Overview</h3>
                    </div>
                    <p class="action-card-description">
                        Book pricing statistics.
                    </p>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-2 bg-blue-50 rounded border-l-4 border-blue-500">
                            <span class="text-sm font-medium text-blue-800">Average Price</span>
                            <span class="text-lg font-bold text-blue-600">${{ number_format(\App\Models\Book::avg('price') ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-green-50 rounded border-l-4 border-green-500">
                            <span class="text-sm font-medium text-green-800">Highest Price</span>
                            <span class="text-lg font-bold text-green-600">${{ number_format(\App\Models\Book::max('price') ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-purple-50 rounded border-l-4 border-purple-500">
                            <span class="text-sm font-medium text-purple-800">Lowest Price</span>
                            <span class="text-lg font-bold text-purple-600">${{ number_format(\App\Models\Book::min('price') ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
