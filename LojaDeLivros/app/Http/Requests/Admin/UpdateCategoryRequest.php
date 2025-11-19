<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $categoryId = $this->route('category')->id;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                Rule::unique('categories', 'name')->ignore($categoryId),
            ],
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
