@extends('layouts.master')

@section('title')
  Laravel Shopping Cart
@endsection

@section('content')

    @foreach ($products->chunk(3) as $productChunk)
      <div class="row">

        @foreach ($productChunk as $product)
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <img class="img-responsive thumbnail" src="{{ $product->imagePath }}" alt="...">
              <div class="caption">
                <h3>{{ $product->title }}</h3>
                <p class="description">{{ $product->description }}</p>
                <div class="pull-left price">{{ $product->price }} zł</div>
                <div class="clearfix"><a href="#" class="btn btn-default pull-right btn-success" role="button">Dodaj do koszyka</a></div>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    @endforeach

@endsection
