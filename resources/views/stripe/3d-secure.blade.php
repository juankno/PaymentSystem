@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card plain-card">
                <div class="card-header">Complete the security steps</div>

                <div class="card-body">
                   <p>You neeed to follow some steps with your bank to complete the payment. Let's do it... {{ $clientSecret }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection