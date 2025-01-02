<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'country' => ['string', 'max:255'],
            'age' => ['numeric', 'required'],
            'phone_number' => ['required', 'numeric', 'regex:/^09[0-9]{8}$/'],
            'role' =>['required','in:patient,doctor,admin'],
            'gender' =>['required','in:male,female'],
            // 'image' => ['nullable','mimes:jpg,jpeg,png','max:2048'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
