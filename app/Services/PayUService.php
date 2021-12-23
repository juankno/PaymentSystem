<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;
use Illuminate\Http\Request;

class PayUService
{
    use ConsumesExternalServices;

    protected $baseUri;
    protected $accountId;
    protected $merchantId;
    protected $key;
    protected $secret;
    protected $baseCurrency;
    protected $converter;


    public function __construct(CurrencyConversionService $converter)
    {
        $this->baseUri = config('services.payu.base_uri');
        $this->accountId = config('services.payu.account_id');
        $this->merchantId = config('services.payu.merchant_id');
        $this->key = config('services.payu.key');
        $this->secret = config('services.payu.secret');
        $this->baseCurrency = config('services.payu.base_currency');
        $this->converter = $converter;
    }


    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $formParams['merchant']['apiKey'] = $this->key;
        $formParams['merchant']['apiLogin'] = $this->secret;
    }


    public function decodeResponse($response)
    {
        return json_decode($response);
    }


    public function handlePayment(Request $request)
    {
        $request->validate([
            "card_token" => "required",
            "card_network" => "required",
            "email" => "required",
            "name" => "required",
        ]);

        $payment = $this->createPayment(
            $request->value,
            $request->currency,
            $request->card_network,
            $request->card_token,
            $request->email,
        );

        if ($payment->status === 'approved') {
            $name = $request->name;
            $currency = strtoupper($payment->currency_id);
            $amount = number_format($payment->transaction_amount, 0, ',', '.');

            $originalAmount = $request->value;
            $originalCurrency = strtoupper($request->currency);

            return redirect()
                ->route('home')
                ->withSuccess(['payment' => "Thanks {$name}. We received your {$originalAmount} {$originalCurrency} payment ({$amount} {$currency})."]);
        }



        return redirect()
            ->route('home')
            ->withErrors('We were unable to confirm your payment. Try again later.');
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


    public function generateSignature()
    {
        //
    }
}
