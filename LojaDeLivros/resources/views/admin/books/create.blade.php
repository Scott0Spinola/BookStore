<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-form-input name="title" label="Title" />
                        <x-form-input name="author" label="Author" />
                        <x-form-textarea name="description" label="Description" />
                        <x-form-input name="price" label="Price" type="number" />
                        <x-form-select name="category_id" label="Category" :options="$categories" />
                        <x-form-input name="image" label="Image" type="file" />
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
