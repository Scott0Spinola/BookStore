<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-form-input name="title" label="Title" :value="$book->title" />
                        <x-form-input name="author" label="Author" :value="$book->author" />
                        <x-form-textarea name="description" label="Description" :value="$book->description" />
                        <x-form-input name="price" label="Price" type="number" :value="$book->price" />
                        <x-form-select name="category_id" label="Category" :options="$categories" :value="$book->category_id" />
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @if($book->image)
                                <img src="{{ $book->image }}" alt="{{ $book->title }}" class="h-20 w-20 object-cover rounded-full mt-2">
                            @endif
                            @error('image')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
