<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
            'publisher_name' =>'required|unique:publisher', 
            'phone_number' => 'required', 
            'city' => 'required', 
            'address' => 'required', 
            'state' => 'required', 
            'zip' => 'required'
        ];
    }
}
