<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3',
            'author' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'author.required' => 'The author is required.',
            'author.min' => 'The author must be at least 3 characters.',
            'description.required' => 'The description is required.',
            'description.min' => 'The description must be at least 10 characters.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }
}
