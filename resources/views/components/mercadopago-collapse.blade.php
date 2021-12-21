@push('styles')

@endpush


<label class="mt-3">Card details:</label>
<div class="form-group form-row">

    <div class="col-5">
        <input type="text" class="form-control" id="cardNumber" data-checkout="cardNumber" placeholder="Card Number" required="">
    </div>

    <div class="col-2">
        <input type="text" class="form-control" data-checkout="securityCode" placeholder="CVC" required="">
    </div>

    <div class="col-1"></div>

    <div class="col-2 col-sm-2 col-md-2 col-lg-1">
        <input type="text" class="form-control" data-checkout="cardExpirationMonth" placeholder="MM" required="">
    </div>

    <div class="col-2 col-sm-2 col-md-2 col-lg-1">
        <input type="text" class="form-control" data-checkout="cardExpirationYear" placeholder="YY" required="">
    </div>

</div>

<div class="form-group form-row">
    <div class="col-5">
        <input type="text" class="form-control" data-checkout="cardholderName" placeholder="Your Name" required="">
    </div>
    <div class="col-5">
        <input type="email" class="form-control" name="email" data-checkout="cardHolderEmail" placeholder="email@example.com" required="">
    </div>
</div>

<div class="form-group form-row">
    <div class="col-2">
        <select class="custom-select" data-checkout="docType"></select>
    </div>
    <div class="col-3">
        <input type="text" class="form-control" data-checkout="docNumber" placeholder="Document" required="">
    </div>
</div>

<div class="form-group form-row">
    <div class="col">
        <small class="form-text text-muted"> Your payment will be converted to {{strtoupper(config('services.mercadopago.base_currency')) }}</small>
    </div>
</div>

<div class="form-group form-row">
    <div class="col">
        <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
    </div>
</div>

<input type="hidden" name="card_token" id="cardToken">
<input type="hidden" name="card_network" id="cardNetwork">

@push('scripts')
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script>
    const mercadopago = window.Mercadopago;

    mercadopago.setPublishableKey("{{ config('services.mercadopago.public_key') }}");

    mercadopago.getIdentificationTypes();
</script>

<script>
    function setCardNetwork() {
        const number = document.getElementById('cardNumber');
        const cardNumber = number.value.trim().split(' ').join('').substring(0, 6);
        mercadopago.getPaymentMethod({
                "bin": cardNumber
            },
            function(status, response) {

                const cardNetwork = document.getElementById('cardNetwork');

                cardNetwork.value = response[0].id

            });
    }
</script>

<script>
    const mercadoPagoForm = document.getElementById('paymentForm');

    mercadoPagoForm.addEventListener('submit', (event) => {
        if (mercadoPagoForm.elements.payment_platform.value === "{{ $platform->id }}") {
            event.preventDefault();

            mercadopago.createToken(mercadoPagoForm, function(status, response) {
                if (status != 200 && status != 201) {
                    const errors = document.getElementById('paymentErrors');
                    errors.textContent = response.cause[0].description;
                } else {

                    setCardNetwork();

                    const cardToken = document.getElementById('cardToken');

                    cardToken.value = response.id;
                    
                    setTimeout(() => {
                        mercadoPagoForm.submit();
                    }, 2000);
                }
            })
        }
    })
</script>
@endpush