<!-- resources/views/layouts/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase text-danger" href="{{ route('home') }}">SneakHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active text-danger' : '' }}" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('shop') ? 'active text-danger' : '' }}" href="{{ route('products') }}">Shop</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active text-danger' : '' }}" href="{{ url('/contact') }}">Contact</a></li>
        @auth
          <li class="nav-item"><a class="nav-link {{ request()->is('my-orders') ? 'active text-danger' : '' }}" href="{{ route('my.orders') }}">My Orders</a></li>
          @if (auth()->user()->email === 'admin123@example.com')
            <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Admin Panel</a></li>
          @endif
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-link nav-link d-inline p-0 ps-lg-3 border-0 align-baseline" style="text-decoration: none;">
                Logout ({{ auth()->user()->name }})
              </button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>

      <!-- === THIS IS THE SEARCH FORM === -->
      <form class="d-flex me-3" role="search" method="GET" action="{{ route('products') }}">
        <input id="globalSearch" class="form-control me-2" type="search" name="search" placeholder="Search sneakers..." aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
      

      <div class="d-flex align-items-center gap-3">
        <!-- Theme toggle -->
        <button id="themeToggle" class="btn btn-link text-white p-0" title="Toggle theme">
          <i id="themeIcon" class="bi bi-moon-fill"></i>
        </button>

        <!-- Mini cart -->
        @php
          $cart = session()->get('cart', []);
          $totalItems = 0;
          foreach ($cart as $id => $details) {
              $totalItems += $details['quantity'];
          }
        @endphp
        
        <a href="{{ route('cart.show') }}" class="position-relative text-decoration-none text-white">
          <i class="bi bi-cart3 fs-4"></i>
          @if($totalItems > 0)
            <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{ $totalItems }}
            </span>
          @endif
        </a>
      </div>
    </div>
  </div>
</nav>