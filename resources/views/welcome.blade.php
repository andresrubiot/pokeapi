@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card text-center">
        <div class="card-body">
          <div class="py-5">
            <img src="{{ asset('images/pokeapi.png') }}" alt="{{ env('APP_NAME') }}">
          </div>

          <a class="btn btn-primary btn-lg" href="{{ route('login') }}">{{ __('Login') }}</a>
          <a class="btn btn-secondary btn-lg" href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
