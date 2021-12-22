<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;
use Illuminate\Http\Request;

class MercadoPagoService
{
    use ConsumesExternalServices;

    protected $baseUri;
    protected $publicKey;
    protected $accessToken;
    protected $baseCurrency;
    protected $converter;


    public function __construct(CurrencyConversionService $converter)
    {
        $this->baseUri = config('services.mercadopago.base_uri');
        $this->publicKey = config('services.mercadopago.public_key');
        $this->accessToken = config('services.mercadopago.access_token');
        $this->baseCurrency = config('services.mercadopago.base_currency');
        $this->converter = $converter;
    }


    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $queryParams['access_token'] = $this->resolveAccessToken();
    }


    public function decodeResponse($response)
    {
        return json_decode($response);
    }


    public function resolveAccessToken()
    {
        return $this->accessToken;
    }


    public function handlePayment(Request $request)
    {
        dd($request->all());
    }


    public function handleApproval()
    {
        //
    }


    public function createPayment($value, $currency, $cardNetwork, $cardToken, $email, $installements = 1)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payments',
            [],
            [
                'payer' => [
                    'email' => $email
                ],
                'binary_mode' => true,
                'transaction_amount' => round($value * $this->resolveFactor($currency)),
                'payment_method_id' => $cardNetwork,
                'token' => $cardToken,
                'installments' => $installements,
                'statement_descriptor' => config('app.name'),
            ],
            [],
            $isJsonRequest = true,
        );
    }


    public function resolveFactor($currency)
    {
        return $this->converter->convertCurrency($currency, $this->baseCurrency);
    }
}
