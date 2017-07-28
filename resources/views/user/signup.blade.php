@extends('layouts.master')
@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1>Rejestracja użytkownika</h1>

      @if (count($errors) > 0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form class="" action="{{ route('user.signup') }}" method="post">

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" name="email" value="" class="form-control">
        </div>

        <div class="form-group">
          <label for="password">Hasło</label>
          <input type="password" name="password" value="" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Utwórz konto</button>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
@endsection
