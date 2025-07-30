<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
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
            'date' => 'required|date',
            'service_id' => 'required|integer|exists:services,id',
            'status' => 'required|in:pending,confirmed,cancelled'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'date.required' => 'You need to select a date.',
            'date.date' => 'Invalid date.',
            'service_id.required' => 'You need to select a service.',
            'service_id.integer' => 'The service ID must be a number.',
            'service_id.exists' => 'Invalid service.',
            'status.required' => 'Booking needs to have a status.',
            'status.in' => 'The status must be one of the following: pending, confirmed, cancelled.'
        ];
    }
}
