<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
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
            'name' => ['required', Rule::unique('services')->ignore($this->id)],
            "description"=> "nullable|max:255",
            "price"=> "required|numeric|gt:1",
            "status"=> "required|in:active,inactive"
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
            "name.required"=> "Provide an unique service name.",
            "name.unique"=> "The service name is already taken.",
            "description.max"=> "The service description must not exceed 255 characters.",
            "price.required"=> "What\'s the service charge ?",
            "price.numeric"=> "The service price must be a number.",
            "price.gt"=> "The service price must be greater than 1.",
            "status.required"=> "The service must have a status.",
            "status.in"=> "The service status must be either 'active' or 'inactive'."
        ];
    }
}
