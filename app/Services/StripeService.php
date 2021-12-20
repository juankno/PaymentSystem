<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;
use Illuminate\Http\Request;

class StripeService
{
    use ConsumesExternalServices;

    protected $key;
    
    protected $secret;
    
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
    }


    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        //
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        //
    }


    public function handlePayment(Request $request)
    {
        //
    }


    public function handleApproval()
    {
       //
    }


    public function resolveFactor(string $currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }

        return 100;
    }
}
