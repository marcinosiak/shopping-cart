@extends('layouts.master')
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Profil użytkownika</h1>
      <hr>
      <h2>Moje zamówienia</h2>

      @foreach ($orders as $order)
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Zamówienie nr {{ $order->id }}</strong></div>
          <div class="panel-body">
            <ul class="list-group">
              @foreach ($order->cart->items as $item)
                <li class="list-group-item">
                  <span class="badge">{{ $item['price'] }} zł</span>
                  {{ $item['item']['title'] }} | {{ $item['qty'] }} szt.
                </li>
              @endforeach
            </ul>
          </div>
          <div class="panel-footer">
            <strong>Total price: {{ $order->cart->totalPrice }} zł</strong>
          </div>
        </div>
      @endforeach

    </div>
  </div>
@endsection
