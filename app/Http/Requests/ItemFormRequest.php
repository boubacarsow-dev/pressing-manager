<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ItemFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $services = collect($this->input('services', []))
            ->filter(fn ($data) => isset($data['selected']))
            ->toArray();

        $this->merge(['services' => $services]);
    }

    public function rules(): array
    {
        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('items', 'nom')->ignore($this->route('item')),
            ],
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['array'],
            'services.*.prix_applique' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $serviceIds = array_keys($this->input('services', []));

                if (!empty($serviceIds) && Service::whereIn('id', $serviceIds)->count() !== count($serviceIds)) {
                    $validator->errors()->add('services', 'Un ou plusieurs services sélectionnés sont invalides.');
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du vêtement est obligatoire.',
            'nom.unique' => 'Ce vêtement existe déjà dans le catalogue.',
            'services.required' => 'Veuillez sélectionner au moins un service.',
            'services.min' => 'Veuillez sélectionner au moins un service.',
            'services.*.prix_applique.required' => 'Veuillez renseigner le prix pour chaque service sélectionné.',
            'services.*.prix_applique.numeric' => 'Le prix appliqué doit être un nombre valide.',
            'services.*.prix_applique.min' => 'Le prix appliqué ne peut pas être négatif.',
        ];
    }
}