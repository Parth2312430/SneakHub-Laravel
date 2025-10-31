<!-- resources/views/layouts/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase text-danger" href="{{ url('/home') }}">SneakHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link {{ request()->is('home') ? 'active text-danger' : '' }}" href="{{ url('/home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('products') ? 'active text-danger' : '' }}" href="{{ url('/products') }}">Shop</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active text-danger' : '' }}" href="{{ url('/contact') }}">Contact</a></li>
      </ul>

      <!-- === THIS IS THE CORRECTED SEARCH FORM === -->
      <form class="d-flex me-3" role="search" method="GET" action="{{ route('products') }}">
        <input id="globalSearch" class="form-control me-2" type="search" name="search" placeholder="Search sneakers..." aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
      <!-- ========================================= -->

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