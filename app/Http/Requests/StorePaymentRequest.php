<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
class StorePaymentRequest extends FormRequest
{
    
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
            'montant' => ['required', 'numeric', 'min:0'],
            'date_paiement' => ['required', 'date'],
        ];
    }

    public function after():array{
        return [
            function (Validator $validator){
                $order = $this->route('');
                if(!$order){
                    return;
                }

                if($order->orderIsPaid()){
                    $validator->errors()->add('order', 'Cette commande est déjà réglée.');
                    return;
                }

                if((float)$this->input('montant') !== (float)$order->montant_total()){
                    $validator->errors()->add('montant', 'Le montant doit être égal au total de la commande (' . $order->montant_total . ' FCFA).');
                    return;
                }
            }
        ];
    }

    public function messages(): array{
        return [
            'montant.required' => 'Le montant est obligatoire.',
            'montant.numeric' => 'Le montant doit être un nombre valide.',
            'date_paiement.required' => 'la date de paiement est obligatoire',
            'date_paiement'
        ];
    }
}
