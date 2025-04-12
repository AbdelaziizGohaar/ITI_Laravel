<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'unique:posts,title',
            ],
            'description' => 'required|string|min:10',
            'post_creator' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,png|max:2048'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'title.min' => 'Title must be at least 3 characters',
            'title.unique' => 'This title already exists',
            'description.required' => 'A description is required',
            'description.min' => 'Description must be at least 10 characters',
            'post_creator.exists' => 'Selected user does not exist'
        ];
    }
}