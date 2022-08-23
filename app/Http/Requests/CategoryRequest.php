<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_category' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255|unique:categories',
            // 'img_category' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'category_id' => 'nullable|exists:categories,id',
            'category_id' => 'nullable',
        ];
    }
}
