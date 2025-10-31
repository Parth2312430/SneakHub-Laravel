<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- === ADD THIS LINE === -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ===================== -->

    <title>SneakHub - @yield('title', 'Home')</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom SneakHub CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicon (optional) -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

  </head>
  <body class="bg-light">
    {{-- Display Success/Error Messages --}}
    @if (session('success'))
        <div class="alert alert-success mb-0">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-0">
            {{ session('error') }}
        </div>
    @endif

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Page Content --}}
    <main class="py-4">
      <div class="container">
        @yield('content')
      </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- NOTE: We removed the old products.js from here -->

  </body>
</html>