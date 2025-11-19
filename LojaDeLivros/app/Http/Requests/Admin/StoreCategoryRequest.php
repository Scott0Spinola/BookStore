<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:3|unique:categories,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'name.min' => 'The category name must be at least 3 characters.',
            'name.unique' => 'This category name already exists.',
        ];
    }
}
