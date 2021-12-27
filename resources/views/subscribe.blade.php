@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card plain-card">
                <div class="card-header">Subscribe</div>

                <div class="card-body">
                    <form action="{{ route('subscribe.store') }}" method="post" id="paymentForm">
                        @csrf

                        <div class="row mt-3">
                            <div class="col">
                                <label>Select your plan: </label>
                                <div class="form-group">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        @foreach ($plans as $plan)
                                        <label class="btn btn-outline-info rounded m-2 p-1">
                                            <input type="radio" name="plan" value="{{ $plan->slug}}" required>
                                            <p class="h2 font-weight-bold text-capitalize">{{ $plan->slug }}</p>
                                            <p class="display-4 text-capitalize">{{ $plan->visual_price }}</p>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
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
                            <button type="submit" id="payButton" class="btn btn-primary float-right">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection