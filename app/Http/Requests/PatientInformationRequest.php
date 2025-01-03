<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientInformationRequest extends FormRequest
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
            'desirable_foods'  => ['nullable', 'string', 'max:1000'],
            'height'           => ['required', 'numeric', 'between:30,300'],
            'patient_id'       => [ 'exists:users,id'],
            'weight'           => ['required', 'numeric', 'between:5,500'],
            'answers'          => [ 'array'],
            'financial_state'  => ['nullable', 'in:finanically comfortable,medium,poor'],
            'health_state'     => ['nullable', 'string', 'max:255'],
        ];
    }
}
