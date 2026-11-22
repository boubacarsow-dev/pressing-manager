<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ServiceRequest extends FormRequest
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
            'libelle' => ['string','required', 'min:4'],
            'description' => ['string','max:50'],
            'tarif' => ['required','numeric','min:10'],
            'actif' => ['string']
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'libelle.required'   => 'Le :attribute est obligatoire.',
            'libelle.string'     => 'Le :attribute doit être une chaîne de caractères.',
            'libelle.min'        => 'Le :attribute doit contenir au moins :min caractères.',

            'description.string' => 'La :attribute doit être une chaîne de caractères.',
            'description.max'    => 'La :attribute ne doit pas dépasser :max caractères.',

            'tarif.required'     => 'Le :attribute est obligatoire.',
            'tarif.numeric'      => 'Le :attribute doit être une valeur numérique.',
            'tarif.min'          => 'Le :attribute doit être supérieur ou égal à :min.',

            'actif.string'       => 'Le champ :attribute doit être une chaîne de caractères.',
        ];
    }

    #[Override]
    public function attributes(): array
    {
        return [
            'libelle'     => 'libellé',
            'description' => 'description',
            'tarif'       => 'tarif',
            'actif'       => 'statut actif',
        ];
    }
}