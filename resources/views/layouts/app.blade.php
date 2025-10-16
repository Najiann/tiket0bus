<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tiket Bus')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional: icon bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold text-danger" href="/">TiketBus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            @auth
              <li class="nav-item">
                <a class="nav-link text-secondary" href="{{ route('bookings.mybookings') }}">Dashboard</a>
              </li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="btn btn-link nav-link text-danger">Logout</button>
                </form>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('login') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('register') }}">Register</a>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>

    {{-- Main content --}}
    <div class="container py-5">
      @yield('content')
    </div>

    {{-- Footer optional --}}
    <footer class="text-center text-muted py-3 border-top">
      <small>© {{ date('Y') }} TiketBus — brum brum</small>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
