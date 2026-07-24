<?php

namespace App\Services\Payments;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use RuntimeException;

class GeniusPayService
{
    public function createCheckout(array $payload): array
    {
        $this->assertConfigured();

        $baseUrl = rtrim((string) config('services.geniuspay.base_url'), '/');
        $body = array_filter([
            'amount' => (int) ($payload['amount'] ?? 0),
            'currency' => $payload['currency'] ?? config('services.geniuspay.currency', 'XOF'),
            'payment_method' => $payload['payment_method'] ?? null,
            'description' => $payload['description'] ?? null,
            'customer' => array_filter([
                'name' => Arr::get($payload, 'customer.name'),
                'email' => Arr::get($payload, 'customer.email'),
                'phone' => Arr::get($payload, 'customer.phone'),
                'country' => Arr::get($payload, 'customer.country'),
            ], static fn ($value) => filled($value)),
            'metadata' => $payload['metadata'] ?? [],
            'success_url' => $payload['success_url'] ?? null,
            'error_url' => $payload['error_url'] ?? null,
            'webhook_url' => $payload['webhook_url'] ?? null,
        ], static fn ($value) => $value !== null && $value !== []);

        try {
            $response = Http::timeout((int) config('services.geniuspay.timeout', 15))
                ->acceptJson()
                ->asJson()
                ->withHeaders([
                    'X-API-Key' => config('services.geniuspay.api_key'),
                    'X-API-Secret' => config('services.geniuspay.api_secret'),
                ])
                ->post($baseUrl.'/payments', $body);

            $response->throw();
        } catch (RequestException $exception) {
            throw new RuntimeException('GeniusPay a refusé la demande de paiement.', previous: $exception);
        }

        return $response->json() ?? [];
    }

    public function checkoutUrl(array $payload): string
    {
        $response = $this->createCheckout($payload);
        $url = data_get($response, 'data.checkout_url') ?? data_get($response, 'data.payment_url');

        if (! is_string($url) || $url === '') {
            throw new RuntimeException('GeniusPay n\'a pas renvoyé d\'URL de paiement.');
        }

        return $url;
    }

    protected function assertConfigured(): void
    {
        if (! config('services.geniuspay.api_key') || ! config('services.geniuspay.api_secret')) {
            throw new RuntimeException('Les identifiants GeniusPay ne sont pas configurés.');
        }
    }
}
