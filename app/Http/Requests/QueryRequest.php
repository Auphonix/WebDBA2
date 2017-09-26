<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change to true to allow validation from this file
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required|alpha|max:255',
            'lastName' => 'required|alpha|max:255',
            'email' => 'required|email|unique:users|max:255',
            'operatingSystem' => 'required|alpha_spaces|max:50',
            'issue' => 'required|alpha_spaces|max:255',
        ];
    }
}
