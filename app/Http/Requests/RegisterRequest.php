<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username'  => ['required', 'alpha_dash', 'max:255', 'unique:users'],
            'email'  => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'digits:12']
        ];
    }

    public function username(): string
    {
        return $this->validated()['username'];
    }

    public function email(): string
    {
        return $this->validated()['email'];
    }

    public function password(): string
    {
        return $this->validated()['password'];
    }

    public function phone_number(): string
    {
        return $this->validated()['phone_number'];
    }
}