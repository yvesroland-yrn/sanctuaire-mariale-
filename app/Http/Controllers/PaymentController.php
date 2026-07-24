<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeniusPayCheckoutRequest;
use App\Services\Payments\GeniusPayService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class PaymentController extends Controller
{
    public function checkout(GeniusPayCheckoutRequest $request, GeniusPayService $geniusPay): RedirectResponse
    {
        try {
            $checkoutUrl = $geniusPay->checkoutUrl([
                'amount' => $request->integer('amount'),
                'currency' => $request->string('currency')->toString() ?: null,
                'description' => $request->string('description')->toString(),
                'payment_method' => $request->filled('payment_method') ? $request->string('payment_method')->toString() : null,
                'customer' => [
                    'name' => $request->string('customer_name')->toString() ?: null,
                    'email' => $request->string('customer_email')->toString() ?: null,
                    'phone' => $request->string('customer_phone')->toString() ?: null,
                    'country' => $request->string('customer_country')->toString() ?: null,
                ],
                'success_url' => $request->string('success_url')->toString() ?: null,
                'error_url' => $request->string('error_url')->toString() ?: null,
                'metadata' => [
                    'source' => 'sanctuaire-web',
                    'donor_type' => $request->string('donor_type')->toString() ?: null,
                    'group_responsable' => $request->string('group_responsable')->toString() ?: null,
                    'paroisse' => $request->string('paroisse')->toString() ?: null,
                    'diocese' => $request->string('diocese')->toString() ?: null,
                    'nombre_personnes' => $request->integer('nombre_personnes') ?: null,
                    'date_arrivee' => $request->string('date_arrivee')->toString() ?: null,
                    'heure_arrivee' => $request->string('heure_arrivee')->toString() ?: null,
                    'date_depart' => $request->string('date_depart')->toString() ?: null,
                    'activite' => $request->string('activite')->toString() ?: null,
                    'hebergement' => $request->string('hebergement')->toString() ?: null,
                    'comments' => $request->string('comments')->toString() ?: null,
                ],
            ]);
        } catch (Throwable $throwable) {
            report($throwable);

            return back()
                ->withInput()
                ->withErrors([
                    'payment' => "Impossible d'initialiser le paiement GeniusPay pour le moment.",
                ]);
        }

        return redirect()->away($checkoutUrl);
    }
}
