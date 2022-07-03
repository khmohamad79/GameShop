<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
            'owner_firstname' => ['required', 'string', 'max:255'],
            'owner_lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'registration_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'bank_account' => ['required', 'string', 'max:255']
        ];
    }
}