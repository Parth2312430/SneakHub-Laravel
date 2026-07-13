@extends('layouts.header')
@section('title','SneakHub | Products')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
  <h2 class="fw-bold">Sneakers Collection</h2>

  <div class="d-flex gap-2 flex-wrap">
    <select id="filterBrand" class="form-select w-auto">
      <option value="">All Brands</option>
    </select>

    <select id="filterCategory" class="form-select w-auto">
      <option value="">All Categories</option>
    </select>

    <select id="filterPrice" class="form-select w-auto">
      <option value="">Any Price</option>
      <option value="0-10000">Under 10,000</option>
      <option value="10000-20000">10,000 – 20,000</option>
      <option value="20000-40000">20,000 – 40,000</option>
      <option value="40000">40,000+</option>
    </select>

    <select id="sortPrice" class="form-select w-auto">
      <option value="">Sort by Price</option>
      <option value="low-high">Low → High</option>
      <option value="high-low">High → Low</option>
    </select>

    <button id="clearFilters" class="btn btn-outline-dark">Clear</button>
  </div>
</div>

<div class="row mb-3">
  <div class="col-12">
    <input id="productsSearch" class="form-control" placeholder="Search sneakers by name, brand, or category...">
  </div>
</div>

<div id="productsGrid" class="row g-3 card-grid">
  <!-- Product cards will render here -->
  <p class="text-center mt-5">Loading products...</p>
</div>

<!-- Product Details Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" class="img-fluid rounded mb-3" style="max-height:250px;">
        <p id="modalDesc" class="text-muted small"></p>
        <h5 class="price mt-2" id="modalPrice"></h5>
        <div class="d-flex justify-content-center gap-2 mt-3">
          <button id="addToCartBtn" class="btn btn-dark px-4">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
          <a id="viewDetailsBtn" href="#" class="btn btn-outline-dark px-4">View Details</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
let products = [];
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// === FIX: Define Base URL so links work on XAMPP ===
const BASE_URL = "{{ url('/') }}"; 

// === FIX: Use BASE_URL for API call ===
fetch(`${BASE_URL}/api/products`)
  .then(res => res.json())
  .then(data => {
    products = data;
    populateFilters(data);

    // Check URL for search term
    const urlParams = new URLSearchParams(window.location.search);
    const navSearchTerm = urlParams.get('search');
    
    if (navSearchTerm) {
      document.getElementById('productsSearch').value = navSearchTerm;
    }

    applyFilters();
  })
  .catch(error => {
      console.error("Error fetching products:", error);
      document.getElementById('productsGrid').innerHTML = '<p class="text-center text-danger">Failed to load products. Check console.</p>';
  });

function populateFilters(data) {
  const brands = [...new Set(data.map(p => p.brand))];
  const categories = [...new Set(data.map(p => p.category))];

  const brandSelect = document.getElementById('filterBrand');
  const catSelect = document.getElementById('filterCategory');

  brands.forEach(b => brandSelect.innerHTML += `<option value="${b}">${b}</option>`);
  categories.forEach(c => catSelect.innerHTML += `<option value="${c}">${c}</option>`);
}

function displayProducts(items) {
  const container = document.getElementById('productsGrid');
  if (items.length === 0) {
    container.innerHTML = '<p class="text-center text-muted">No products found matching your criteria.</p>';
    return;
  }
  container.innerHTML = items.map(p => `
    <div class="col-md-4 col-sm-6">
      <div class="card border-0 shadow-sm h-100 d-flex flex-column">
        <div class="card-img-container">
          <!-- FIX: Use BASE_URL for image -->
          <img src="${BASE_URL}/${p.image}" class="card-img-top" alt="${p.name}">
        </div>
        <div class="card-body text-center d-flex flex-column flex-grow-1">
          <div class="mb-2">
            <span class="badge bg-dark">${p.brand}</span>
            ${p.stock <= 0 ? `<span class="badge bg-danger">Out of Stock</span>` : ''}
          </div>
          <h6 class="card-title fw-bold">${p.name}</h6>
          <p class="price text-danger fw-bold">PKR ${p.price}</p>
          <button class="btn btn-outline-dark btn-sm rounded-pill px-3 mt-auto" onclick="openModal(${p.id})">
            Quick View
          </button>
        </div>
      </div>
    </div>
  `).join('');
}

// Event Listeners
document.getElementById('productsSearch').addEventListener('input', applyFilters);
document.getElementById('filterBrand').addEventListener('change', applyFilters);
document.getElementById('filterCategory').addEventListener('change', applyFilters);
document.getElementById('filterPrice').addEventListener('change', applyFilters);
document.getElementById('sortPrice').addEventListener('change', applyFilters);
document.getElementById('clearFilters').addEventListener('click', () => {
  document.getElementById('filterBrand').value = '';
  document.getElementById('filterCategory').value = '';
  document.getElementById('filterPrice').value = '';
  document.getElementById('sortPrice').value = '';
  document.getElementById('productsSearch').value = '';
  applyFilters();
});

function applyFilters() {
  let filtered = [...products];

  const brand = document.getElementById('filterBrand').value;
  const cat = document.getElementById('filterCategory').value;
  const price = document.getElementById('filterPrice').value;
  const sort = document.getElementById('sortPrice').value;
  const search = document.getElementById('productsSearch').value.toLowerCase();

  if (brand) filtered = filtered.filter(p => p.brand === brand);
  if (cat) filtered = filtered.filter(p => p.category === cat);
  if (price) {
    const [min, max] = price.split('-').map(Number);
    if(max) {
        filtered = filtered.filter(p => p.price >= min && p.price <= max);
    } else {
        filtered = filtered.filter(p => p.price >= min);
    }
  }
  if (search)
    filtered = filtered.filter(p =>
      p.name.toLowerCase().includes(search) ||
      p.brand.toLowerCase().includes(search) ||
      p.category.toLowerCase().includes(search)
    );

  if (sort === 'low-high') filtered.sort((a, b) => a.price - b.price);
  if (sort === 'high-low') filtered.sort((a, b) => b.price - a.price);

  displayProducts(filtered);
}

function openModal(id) {
  const p = products.find(x => x.id == id);
  if (!p) return;
  document.getElementById('modalTitle').innerText = p.name;
  
  // FIX: Use BASE_URL for modal image
  document.getElementById('modalImage').src = `${BASE_URL}/${p.image}`;
  
  document.getElementById('modalDesc').innerText = p.description;
  document.getElementById('modalPrice').innerText = `PKR ${p.price}`;
  
  // FIX: Use BASE_URL for details link
  document.getElementById('viewDetailsBtn').href = `${BASE_URL}/product/${p.id}`;
  
  const cartBtn = document.getElementById('addToCartBtn');
  const newCartBtn = cartBtn.cloneNode(true);
  cartBtn.parentNode.replaceChild(newCartBtn, cartBtn);
  
  if (p.stock <= 0) {
    newCartBtn.disabled = true;
    newCartBtn.innerHTML = `<i class="bi bi-x-circle"></i> Out of Stock`;
    newCartBtn.className = "btn btn-secondary px-4";
  } else {
    newCartBtn.disabled = false;
    newCartBtn.innerHTML = `<i class="bi bi-cart-plus"></i> Add to Cart`;
    newCartBtn.className = "btn btn-dark px-4";
    newCartBtn.addEventListener('click', () => {
      addItemToCart(p.id);
    });
  }

  const modal = new bootstrap.Modal(document.getElementById('productModal'));
  modal.show();
}

function addItemToCart(id) {
  // FIX: Use BASE_URL for cart add
  fetch(`${BASE_URL}/cart/add/${id}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({
      quantity: 1
    })
  })
  .then(response => {
    if (response.ok) {
      window.location.reload(); 
    } else {
      alert('There was a problem adding the item to the cart.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('There was a problem adding the item to the cart.');
  });
}
</script>
@endsection