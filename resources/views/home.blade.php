@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card plain-card">
                <div class="card-header">Make a payment</div>

                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form" id="payment-form">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label for="amount">How much you want to pay</label>
                                <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="5" value="{{ mt_rand(500, 100000) /100 }}">
                                <small class="form-text text-muted">
                                    Use values with up to two decimal positions,
                                    using dot " . "
                                </small>
                            </div>
                            <div class="col-auto">
                                <label for="currency">Currency</label>
                                <select name="currency" id="currency" class="custom-select">
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->iso }}">{{ strtoupper($currency->iso) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" id="payButton" class="btn btn-primary">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection