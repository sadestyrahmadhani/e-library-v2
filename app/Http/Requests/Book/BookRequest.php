<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    private $routeName;
    
    public function __construct()
    {
        $this->routeName = request()->route()->getName();
    }

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
    public function rules(): array
    {
        return [
            'genre_id' => 'required',
            'name' => 'required',
            'publication_year' => 'required',
            'author' => 'required',
            'file' => [
                $this->routeName == 'admin.books.store' ? 'required' : 'nullable',
                'mimes:jpg,jpeg,png,gif'
            ]
        ];
    }
}
