<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'book_name' => 'required|unique:book',
            'date_release' => 'required',
            'author_id' => 'required',
            'description' => 'required',
            'number_of_page' => 'required', 
            'publisher_id' => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'book_name.required' => 'Book Name is required!',
            'book_name.unique' => 'Book Name must be unique!',
        ];
    }
}
