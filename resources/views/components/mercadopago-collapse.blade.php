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

    <div class="col-1">
        <input type="text" class="form-control" data-checkout="cardExpirationMonth" placeholder="MM" required="">
    </div>

    <div class="col-1">
        <input type="text" class="form-control" data-checkout="cardExpirationYear" placeholder="YY" required="">
    </div>

</div>

<div class="form-group form-row">
    <div class="col-5">
        <input type="text" class="form-control" data-checkout="cardHolderName" placeholder="Your Name" required="">
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

@push('scripts')
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script>
    const mercadopago = window.Mercadopago;

    mercadopago.setPublishableKey("{{ config('services.mercadopago.public_key') }}");

    mercadopago.getIdentificationTypes();
</script>
@endpush