<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GeniusPayCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => ['required', 'integer', 'min:' . (int) config('services.geniuspay.minimum_amount', 200)],
            'currency' => ['nullable', 'string', 'size:3'],
            'description' => ['required', 'string', 'max:255'],
            'payment_method' => ['nullable', 'string', Rule::in(['wave', 'orange_money', 'mtn_money', 'moov_money', 'card', 'pawapay', 'paystack'])],
            'donor_type' => ['nullable', 'string', Rule::in(['anonyme', 'identifie'])],
            'customer_name' => ['nullable', 'string', 'max:255'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:30'],
            'customer_country' => ['nullable', 'string', 'size:2'],
            'group_responsable' => ['nullable', 'string', 'max:255'],
            'paroisse' => ['nullable', 'string', 'max:255'],
            'diocese' => ['nullable', 'string', 'max:255'],
            'nombre_personnes' => ['nullable', 'integer', 'min:1'],
            'date_arrivee' => ['nullable', 'date'],
            'heure_arrivee' => ['nullable', 'date_format:H:i'],
            'date_depart' => ['nullable', 'date'],
            'activite' => ['nullable', 'string', 'max:255'],
            'hebergement' => ['nullable', 'string', Rule::in(['oui', 'non'])],
            'comments' => ['nullable', 'string', 'max:2000'],
            'success_url' => ['nullable', 'url', 'max:255'],
            'error_url' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Le montant est requis.',
            'amount.min' => 'Le montant minimum autorisé est de ' . (int) config('services.geniuspay.minimum_amount', 200) . ' FCFA.',
            'description.required' => 'La description du paiement est requise.',
            'customer_email.email' => 'L\'email du client doit être valide.',
            'customer_country.size' => 'Le code pays doit contenir 2 caractères.',
            'heure_arrivee.date_format' => 'L\'heure d\'arrivée doit être au format HH:MM.',
        ];
    }
}
