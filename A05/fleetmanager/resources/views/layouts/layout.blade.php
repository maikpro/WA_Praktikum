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



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <a class="navbar-brand" href="#">Schiffsdatenbank</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('ships') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('ships') }}">Schiffe</a>
                </li>
                <li class="nav-item {{ Request::is('manufacturers') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('manufacturers') }}">Hersteller</a>
                </li>
                <li class="nav-item {{ Request::is('shipmodels') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('shipmodels') }}">Modelle</a>
                </li>
            </ul>
        </div>
        <form method="post" action="{{ url('logout') }}">
            @csrf
            <input type="submit" class="btn btn-danger" value="Abmelden">
        </form>
    </nav>



    <div class="container-fluid">

        <div class="p-5">
            @yield('content')
        </div>

    </div>




</body>

</html>
