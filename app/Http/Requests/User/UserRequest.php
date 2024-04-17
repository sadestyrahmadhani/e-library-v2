<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required',
                'email',
                $this->routeName == 'admin.users.store' ? 'unique:users,email' : Rule::unique('users', 'email')->ignoreModel($this->user)
            ],
            'username' => [
                'required',
                $this->routeName == 'admin.users.store' ? 'unique:users,username' : Rule::unique('users', 'username')->ignoreModel($this->user)
            ],
            'password' => $this->routeName == 'admin.users.store' ? 'required' : 'nullable',
            'confirm_password' => [
                $this->routeName == 'admin.users.store' ? 'required' : 'nullable',
                'required_with:password',
                'same:password',
            ],
            'role' => 'required'
        ];
    }
}
