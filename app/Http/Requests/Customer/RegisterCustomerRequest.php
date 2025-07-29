<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email'=> 'required|email|unique:customers',
            'phone' => 'required|digits:11,11|unique:customers',
            'password' => 'required',
            'address' => 'nullable'
        ];
    }

    /**
     * Get the custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'What\'s your name ?.',
            'email.required' => 'Provide an email address.',
            'email.email' => 'Invalid email address.',
            'email.unique' => 'The email has already been taken.',
            'phone.required' => 'What\'s your phone number ?.',
            'phone.unique' => 'The phone number has already been taken.',
            'phone.digits' => 'The phone number must be exactly 11 digits.',
            'password.required' => 'Password for your account is a must.'
        ];
    }
}
