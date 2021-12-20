@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card plain-card">
                <div class="card-header">Make a payment</div>

                <div class="card-body">
                    <form action="{{ route('pay') }}" method="post" id="paymentForm">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label for="value">How much you want to pay</label>
                                <input type="number" name="value" id="value" class="form-control" step="0.01" min="5" value="{{ mt_rand(500, 100000) /100 }}" required>
                                <small class="form-text text-muted">
                                    Use values with up to two decimal positions,
                                    using dot " . "
                                </small>
                            </div>
                            <div class="col-auto">
                                <label for="currency">Currency</label>
                                <select name="currency" id="currency" class="custom-select" required>
                                    @foreach ($currencies as $currency)
                                    <option value="{{ $currency->iso }}">{{ strtoupper($currency->iso) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Select the desired payment platform: </label>
                                <div class="form-group" id="toggler">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        @foreach ($paymentPlatforms as $platform)
                                        <label class="btn btn-outline-secondary rounded m-2 p-1" data-target="#{{$platform->name}}Collapse" data-toggle="collapse">
                                            <input type="radio" name="payment_platform" value="{{ $platform->id}}" required>
                                            <img class="img-thumbnail" src="{{ asset($platform->image) }}" alt="{{ $platform->name }}">
                                        </label>
                                        @endforeach
                                    </div>
                                    @foreach ($paymentPlatforms as $platform)
                                    <div id="{{$platform->name}}Collapse" class="collapse" data-parent="#toggler">
                                        @includeIf('components.' . strtolower($platform->name). '-collapse')
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" id="payButton" class="btn btn-primary float-right">Pay Now!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection