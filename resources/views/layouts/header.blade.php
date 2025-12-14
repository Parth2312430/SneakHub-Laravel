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
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
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

    <!-- Dark Mode Toggle Script -->
    <script>
      // Check for saved theme preference or default to light mode
      const currentTheme = localStorage.getItem('theme') || 'light';
      if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        document.getElementById('themeIcon')?.classList.replace('bi-moon-fill', 'bi-sun-fill');
      }

      // Toggle theme on button click
      document.getElementById('themeToggle')?.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const icon = document.getElementById('themeIcon');
        
        if (document.body.classList.contains('dark-mode')) {
          icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
          localStorage.setItem('theme', 'dark');
        } else {
          icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
          localStorage.setItem('theme', 'light');
        }
      });
    </script>

  </body>
</html>