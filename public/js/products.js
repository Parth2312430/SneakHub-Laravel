// public/js/products.js
document.addEventListener('DOMContentLoaded', function(){
  const dataUrl = '/data/products.json';
  let products = [];

  // Cart storage key
  const CART_KEY = 'fitsync_cart';
  // Theme key
  const THEME_KEY = 'fitsync_theme';

  fetch(dataUrl).then(r => r.json()).then(d => {
    products = d;
    init(products);
    updateCartCounter();
  }).catch(e => {
    console.error('Failed to load products.json', e);
  });

  function init(products){
    populateCategoryFilter(products);
    setupCategoryTabs(products);
    renderProducts(products);
    renderFeatured(products);
    setupEventHandlers(products);
    applySearchFromGlobal();
    initThemeToggle();
  }

  function setupEventHandlers(products){
    const searchInput = document.getElementById('productsSearch');
    const categoryFilter = document.getElementById('filterCategory');
    const priceFilter = document.getElementById('filterPrice');
    const sortPrice = document.getElementById('sortPrice');
    const clearBtn = document.getElementById('clearFilters');

    searchInput?.addEventListener('input', () => applyFilters());
    categoryFilter?.addEventListener('change', () => applyFilters());
    priceFilter?.addEventListener('change', () => applyFilters());
    sortPrice?.addEventListener('change', () => applyFilters());
    clearBtn?.addEventListener('click', () => {
      searchInput.value = '';
      categoryFilter.value = '';
      priceFilter.value = '';
      sortPrice.value = '';
      document.querySelectorAll('#categoryTabs .nav-link').forEach(n => n.classList.remove('active'));
      document.querySelector('#categoryTabs .nav-item .nav-link')?.classList.add('active');
      renderProducts(products);
    });

    document.getElementById('searchBtn')?.addEventListener('click', function(){
      const q = document.getElementById('globalSearch').value.trim().toLowerCase();
      localStorage.setItem('fitsync_search', q);
      window.location.href = '/products';
    });
  }

  function applySearchFromGlobal(){
    const q = localStorage.getItem('fitsync_search');
    if(q){
      const searchInput = document.getElementById('productsSearch');
      if(searchInput){
        searchInput.value = q;
        applyFilters();
      }
      localStorage.removeItem('fitsync_search');
    }
  }

  function applyFilters(){
    const searchInput = document.getElementById('productsSearch');
    const categoryFilter = document.getElementById('filterCategory');
    const priceFilter = document.getElementById('filterPrice');
    const sortPrice = document.getElementById('sortPrice');

    let list = [...products];
    const q = searchInput?.value.trim().toLowerCase() || '';
    const cat = categoryFilter?.value || '';
    const price = priceFilter?.value || '';
    const sort = sortPrice?.value || '';

    if(q) list = list.filter(p => p.name.toLowerCase().includes(q) || p.description.toLowerCase().includes(q));
    if(cat) list = list.filter(p => p.category === cat);
    if(price){
      const [min,max] = price.split('-').map(Number);
      list = list.filter(p => max ? (p.price >= min && p.price <= max) : (p.price >= min));
    }
    if(sort === 'low-high') list.sort((a,b)=> a.price - b.price);
    if(sort === 'high-low') list.sort((a,b)=> b.price - a.price);

    renderProducts(list);
  }

  function populateCategoryFilter(products){
    const cats = [...new Set(products.map(p => p.category))].sort();
    const sel = document.getElementById('filterCategory');
    if(!sel) return;
    cats.forEach(c => {
      const o = document.createElement('option'); o.value = c; o.textContent = c;
      sel.appendChild(o);
    });
  }

  function setupCategoryTabs(products){
    const cats = [...new Set(products.map(p => p.category))].sort();
    const tabs = document.getElementById('categoryTabs');
    if(!tabs) return;
    // remove existing except the first All tab
    tabs.querySelectorAll('li.nav-item:not(:first-child)').forEach(n => n.remove());
    cats.forEach(c => {
      const li = document.createElement('li'); li.className = 'nav-item';
      const a = document.createElement('a');
      a.className = 'nav-link';
      a.textContent = c;
      a.href = '#';
      a.dataset.cat = c;
      a.addEventListener('click', function(e){
        e.preventDefault();
        // activate
        tabs.querySelectorAll('.nav-link').forEach(n => n.classList.remove('active'));
        a.classList.add('active');
        // apply category and render
        document.getElementById('filterCategory').value = c;
        applyFilters();
      });
      li.appendChild(a);
      tabs.appendChild(li);
    });
  }

  function renderProducts(list){
    const grid = document.getElementById('productsGrid');
    if(!grid) return;
    grid.innerHTML = '';
    if(list.length === 0){ grid.innerHTML = '<div class="col-12 text-center py-4">No products found.</div>'; return; }

    list.forEach(p => {
      const col = document.createElement('div');
      col.className = 'col-sm-6 col-md-4 col-lg-3';
      col.innerHTML = `
        <div class="card h-100 shadow-sm">
          <img src="${p.image}" class="card-img-top" alt="${p.name}">
          <div class="card-body d-flex flex-column">
            <div class="mb-2"><span class="badge-category">${p.category}</span></div>
            <h5 class="card-title">${p.name}</h5>
            <p class="small text-muted mb-2">${p.description}</p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <div class="price">Rs. ${p.price.toLocaleString()}</div>
              <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary viewBtn" data-id="${p.id}">View</button>
                <button class="btn btn-sm btn-outline-success addCartBtn" data-id="${p.id}"><i class="bi bi-cart-plus"></i></button>
              </div>
            </div>
          </div>
        </div>`;
      grid.appendChild(col);
    });

    // attach events
    document.querySelectorAll('.viewBtn').forEach(btn => {
      btn.addEventListener('click', e => {
        const id = Number(e.currentTarget.dataset.id);
        const prod = products.find(p => p.id === id);
        if(prod) showModal(prod);
      });
    });

    document.querySelectorAll('.addCartBtn').forEach(btn => {
      btn.addEventListener('click', e => {
        const id = Number(e.currentTarget.dataset.id);
        addToCart(id, 1);
      });
    });
  }

  function renderFeatured(products){
    const row = document.getElementById('featuredRow');
    if(!row) return;
    row.innerHTML = '';
    products.slice(0,4).forEach(p => {
      const col = document.createElement('div'); col.className = 'col-md-3';
      col.innerHTML = `
        <div class="card h-100 shadow-sm">
          <img src="${p.image}" class="card-img-top" alt="${p.name}">
          <div class="card-body">
            <h6 class="card-title">${p.name}</h6>
            <div class="price">Rs. ${p.price.toLocaleString()}</div>
          </div>
        </div>`;
      row.appendChild(col);
    });
  }

  function showModal(p){
    document.getElementById('modalTitle').textContent = p.name;
    document.getElementById('modalImage').src = p.image;
    document.getElementById('modalDesc').textContent = p.description;
    document.getElementById('modalPrice').textContent = `Rs. ${p.price.toLocaleString()}`;
    document.getElementById('viewDetailsBtn').href = `/product/${p.id}`;
    const modalEl = document.getElementById('productModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();

    // add to cart button inside modal
    const addBtn = document.getElementById('addToCartBtn');
    addBtn.onclick = () => {
      addToCart(p.id, 1);
      // feedback
      addBtn.textContent = 'Added ✓';
      setTimeout(()=> addBtn.innerHTML = '<i class="bi bi-cart-plus"></i> Add to Cart', 900);
    };
  }

  // CART helpers (localStorage)
  function getCart(){
    try {
      const raw = localStorage.getItem(CART_KEY);
      return raw ? JSON.parse(raw) : {};
    } catch(e){ return {}; }
  }
  function saveCart(cart){
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    updateCartCounter();
  }
  function addToCart(productId, qty){
    const cart = getCart();
    const key = String(productId);
    cart[key] = (cart[key] || 0) + (qty || 1);
    saveCart(cart);
    // small toast-like feedback
    showToast('Added to cart');
  }
  function getCartCount(){
    const cart = getCart();
    return Object.values(cart).reduce((s,a)=> s + Number(a), 0);
  }
  function updateCartCounter(){
    const elem = document.getElementById('cartCount');
    if(!elem) return;
    const count = getCartCount();
    elem.textContent = String(count);
    elem.style.display = count > 0 ? 'inline-block' : 'none';
  }

  // small toast helper (simple)
  function showToast(msg){
    // use a quick alert-like small floating message
    const toast = document.createElement('div');
    toast.className = 'fitsync-toast';
    toast.textContent = msg;
    document.body.appendChild(toast);
    setTimeout(()=> {
      toast.classList.add('visible');
      setTimeout(()=> {
        toast.classList.remove('visible');
        setTimeout(()=> toast.remove(), 400);
      }, 900);
    }, 10);
  }

  // product details page renderer (if productId is present)
  if(typeof productId !== 'undefined' && productId !== null){
    const prod = () => products.find(p => Number(p.id) === Number(productId));
    const renderDetail = () => {
      const p = prod();
      const wrap = document.getElementById('detailContent');
      if(!wrap) return;
      if(!p){
        wrap.innerHTML = '<div class="col-12">Product not found.</div>';
        return;
      }
      wrap.innerHTML = `
        <div class="col-md-6 text-center">
          <img src="${p.image}" class="img-fluid rounded" alt="${p.name}">
        </div>
        <div class="col-md-6">
          <h2>${p.name}</h2>
          <div class="mb-2"><span class="badge-category">${p.category}</span></div>
          <h4 class="price">Rs. ${p.price.toLocaleString()}</h4>
          <p class="text-muted">${p.description}</p>
          <div class="d-flex gap-2">
            <button id="detailAddBtn" class="btn btn-success"><i class="bi bi-cart-plus"></i> Add to Cart</button>
            <a href="/products" class="btn btn-outline-secondary">Back to Products</a>
          </div>
        </div>
      `;
      document.getElementById('detailAddBtn').addEventListener('click', ()=> {
        addToCart(p.id, 1);
      });
    };
    // wait until products loaded
    const waitForProducts = setInterval(()=> {
      if(products.length){
        renderDetail();
        clearInterval(waitForProducts);
      }
    }, 80);
  }

  // THEME toggle
  function initThemeToggle(){
    const toggle = document.getElementById('themeToggle');
    const icon = document.getElementById('themeIcon');
    if(!toggle) return;

    function applyTheme(theme){
      if(theme === 'dark') document.documentElement.classList.add('dark-mode');
      else document.documentElement.classList.remove('dark-mode');
      localStorage.setItem(THEME_KEY, theme);
      icon.className = (theme === 'dark') ? 'bi bi-sun' : 'bi bi-moon';
    }

    // initial icon set
    const saved = localStorage.getItem(THEME_KEY) || 'light';
    icon.className = (saved === 'dark') ? 'bi bi-sun' : 'bi bi-moon';

    toggle.addEventListener('click', () => {
      const current = localStorage.getItem(THEME_KEY) || 'light';
      const next = current === 'dark' ? 'light' : 'dark';
      applyTheme(next);
    });
  }
});
