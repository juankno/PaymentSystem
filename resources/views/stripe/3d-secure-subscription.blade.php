@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card plain-card">
                <div class="card-header">Complete the security steps</div>

                <div class="card-body">
                    <p>You neeed to follow some steps with your bank to complete the payment. Let's do it...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");

    stripe.confirmCardPayment(
            "{{$clientSecret}}", {
                payment_method: "{{$paymentMethod}}"
            },
        )
        .then(res => {
            if (res.error) {
                window.location.replace("{{ route('subscribe.cancelled') }}");
            } else {
                window.location.replace("{!! route('subscribe.approval', [ 'plan' => $plan, 'subscription_id' => $subscriptionId]) !!}");
            }
        })
</script>
@endpush