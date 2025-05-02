<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Katalog Aset Potensial | Jamkrindo Kanwil IX Makassar</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-square.png') }}" alt="Logo" style="width: 18px;"/>&nbsp;&nbsp;Katalog Aset Potensial
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item"><a class="nav-link" href="/">Home</a>
                        <li class="nav-item"><a class="nav-link" href="{{route('listings')}}">Listing</a>
                        <li class="nav-item"><a class="nav-link" href="/">Kontak Kami</a>
                        @else

                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="bg-dark text-white py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Column 1 -->
      <div class="col-md-4">
      <img src="{{ asset('images/logo-footer.webp') }}" alt="Logo" style="width: 280px;"/>
      </div>
      <!-- Column 2 -->
      <div class="col-md-4">
        <h5>PT. Jamkrindo Kanwil IX Makassar</h5>
        <p>Jl. Lamaddukelleng No.25B, Losari, Kec. Ujung Pandang, Kota Makassar, Sulawesi Selatan 90113<br/>
        PT Jamkrindo merupakan perusahaan penjamin terbesar di Indonesia</p>
      </div>

      <!-- Column 3 -->
      <div class="col-md-4">
        <h5>Kontak Kami</h5>
        <ul class="list-unstyled">
          <li><a href="https://jamkrindo.co.id" class="text-white text-decoration-none">Website PT. Jamkrindo</a></li>
          <li><a href="https://www.jamkrindo.co.id/kanwil-makassar" class="text-white text-decoration-none">Unit Kerja</a></li>
          <li>Email: contact@jamkrindo.co.id</li>
          <li>Telepon: (0411) 875836</li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
