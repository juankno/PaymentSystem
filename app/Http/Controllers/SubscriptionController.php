<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resolvers\PaymentPlatformResolver;
use App\Models\PaymentPlatform;
use App\Models\Plan;

class SubscriptionController extends Controller
{

    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }


    public function show()
    {
        $paymentPlatforms = PaymentPlatform::where('subscriptions_enabled', false)->get(); // TODO: just payment platforms that is active

        return view('subscribe')->with([
            'plans' => Plan::all(),
            'paymentPlatforms' => $paymentPlatforms
        ]);
    }

    public function approval()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'plan' => 'required|exists:plans,slug',
            'payment_platform' => 'required|exists:payment_platforms,id'
        ];

        $request->validate($rules);

        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);

        session()->put('subscriptionPlatformId', $request->payment_platform);

        $paymentPlatform->handleSubscription($request); // TODO: pending subscription 
    }

    public function cancelled()
    {
        //
    }
}
