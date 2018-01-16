@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="#charge-message" class="alert alert-success"> {{ Session::get('success') }}</div>
        </div>
    </div>
    @endif

    <!--<form action="{{ route('check') }}" method="post" id="check-form">
        <div class="form-row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">E-mail</label>
                        <input class="form-control" type="text" name="email" id="email" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="address">Password</label>
                        <input class="form-control" type="text" name="password" id="password" required>
                    </div>
                </div>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-success" type="submit">Submit</button>
    </form>-->

    @foreach($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ $product->imagePath }}" style="max-height: 150px" class="img-responsive" alt="...">
                        <div class="caption">
                            <h3>{{ $product->title }}</h3>
                            <p>{{ $product->description }}</p>
                            <div class="clearfix">
                                <div class="pull-left">$ {{ $product->price }}</div>
                                <a href="{{ route('addToCart', $product->id) }}" class="btn btn-primary pull-right"
                                   role="button">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
