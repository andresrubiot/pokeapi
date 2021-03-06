<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('images/favicon.ico') }}">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Authenticated user -->
  <meta name="user" content="{{ Auth::user() }}">

  
  <title>{{ config('app.name', 'Laravel') }}</title>
  
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    
    @include('layouts.nav')
    
    <main class="container-fluid py-4">
      @yield('content')
      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>
    </main>
  </div>
</body>
</html>
