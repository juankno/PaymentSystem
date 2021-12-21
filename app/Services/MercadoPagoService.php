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


    public function __construct()
    {
        $this->baseUri = config('services.mercadopago.base_uri');
        $this->publicKey = config('services.mercadopago.public_key');
        $this->accessToken = config('services.mercadopago.access_token');
        $this->baseCurrency = config('services.mercadopago.base_currency');
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
        //
    }
}
