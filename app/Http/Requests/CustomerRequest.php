<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CustomerRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'min:5', 'max:30'],
            'adresse' => ['max:50'],
            'tel' => ['required', 'unique:customers,tel', 'max:10', 'min:10']
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est requis.',
            'nom.max' => 'Le nom ne peut pas dépasser 30 caractères.',
            'adresse.max' => 'L\'adresse ne peut pas dépasser 50 caractères.',
            'tel.unique' => 'Ce numéro existe déjà.',
            'tel.max' => 'Le numéro ne peut pas dépasser 10 chiffres.',
            'tel.min' => 'Le numéro doit faire au moins 10 chiffres.',
            'tel.required' => 'Le numéro de téléphone est requis.'
        ];
    }

    #[Override]
    public function attributes()
    {
        return [
            'nom' => 'le nom',
            'tel' => 'telephone',
            'adresse' => 'l\'adresse'
        ];
    }
}
