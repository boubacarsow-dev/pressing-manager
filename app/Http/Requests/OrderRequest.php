<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'date_depot' => ['required', 'date'],
            'livraison_prev' => ['required', 'date', 'after_or_equal:date_depot'],
            'statut' => ['sometimes', 'in:reçue,en traitement,prête,récupérée'],
            'lines' => ['required', 'array', 'min:1'],
            'lines.*.item_id' => ['required', 'exists:items,id'],
            'lines.*.service_id' => ['required', 'exists:services,id'],
            'lines.*.quantite' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Veuillez sélectionner un client.',
            'date_depot.required' => 'La date de dépôt est obligatoire.',
            'livraison_prev.required' => 'La date de livraison prévue est obligatoire.',
            'livraison_prev.after_or_equal' => 'La livraison prévue doit être après ou le même jour que le dépôt.',
            'lines.required' => 'Ajoutez au moins un vêtement à la commande.',
            'lines.*.item_id.required' => 'Choisissez un vêtement.',
            'lines.*.service_id.required' => 'Choisissez un service.',
            'lines.*.quantite.required' => 'Indiquez la quantité.',
            'lines.*.quantite.min' => 'La quantité doit être au moins 1.',
        ];
    }
}