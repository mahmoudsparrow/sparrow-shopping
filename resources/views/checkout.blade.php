@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <h1>Checkout</h1>
            <h4>Your total price: ${{ $total }}</h4>
            <div id="charge-error"
                 class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }} ">{{ Session::get('error') }}</div>
            <form action="{{ route('checkout') }}" method="post" id="payment-form">
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" id="name" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" id="address" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="card-hold">Card Holder Name</label>
                                <input class="form-control" type="text" id="card-hold" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="card-number">Credit Card Number</label>
                                <input class="form-control" type="text" id="card-number" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="card-expiry-month">Expiration Month</label>
                                <input class="form-control" type="text" id="card-expiry-month" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="card-expiry-year">Expiration Year</label>
                                <input class="form-control" type="text" id="card-expiry-year" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="cvc">CVC</label>
                                <input class="form-control" type="text" id="cvc" required>
                            </div>
                        </div>
                    </div>

                    <!-- Used to display Element errors -->
                    <div id="card-errors" role="alert"></div>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-success" type="submit">Submit Payment</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="{{ asset('js/checkout.js') }}"></script>
@endsection
