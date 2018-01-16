@extends('layouts.app')

@section('content')
    @if (Session::has('cart'))
        @if ($products != null)
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <ul class="list-group">
                        @foreach($products as $product)
                            <li class="list-group-item">
                                <span class="badge">{{ $product['price'] }}</span>
                                <span class="badge">Total </span>
                                <span>
                                    <img src="{{ $product['item']['imagePath'] }}" class="img-responsive"
                                         style="max-height: 50px; max-width: 40px">
                                    <strong>{{ $product['item']['title'] }}</strong>
                                </span>
                                <span class="label label-primary">{{ $product['item']['price'] }}
                                    X {{ $product['qty'] }}</span>
                            <!--<span class="label label-success">{{ $product['price'] }}</span>-->
                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle"
                                        data-toggle="dropdown">
                                    Action<span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('removeFromCart', $product['item']['id']) }}">Remove an
                                            item</a></li>
                                    <li><a href="{{ route('removeAllItems', $product['item']['id']) }}">Remove all
                                            items</a></li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <strong>Total = {{ $totalPrice }}</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <h2>No items in the cart</h2>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No items in the cart</h2>
            </div>
        </div>
    @endif
@endsection
