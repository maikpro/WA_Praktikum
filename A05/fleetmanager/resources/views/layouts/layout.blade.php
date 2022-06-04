<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Schiffsdatenbank</title>
  </head>
  <body>
    <form method="post" action="{{url('logout')}}">
      @csrf
      <input type="submit" class="btn btn-danger" value="Abmelden">
    </form>
    <div class="container">
        @yield('content')
    </div>

  </body>
</html>