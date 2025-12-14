<h1 align="center">SneakHub (Laravel)</h1>

SneakHub is a sneaker storefront with a public shop, product details with reviews, and an admin panel to manage products, brands, and categories. It includes AJAX search, public APIs, image previews, and light/dark theme support.

## Features
- Public shop: browse, search, filter, and view product details
- Reviews: authenticated users can rate and comment on products
- Admin CRUD: products, brands, categories (with image upload & previews)
- AJAX search: admin product/brand search dropdowns
- APIs: products, categories, brands exposed as JSON
- Seed data: 30 products + brands + categories via `MasterSeeder`
- Light/dark theme toggle on the public site

## Tech Stack
- PHP 8.1+ / Laravel 10+
- MySQL
- Vite, Bootstrap 5, Tailwind utility classes (light usage)
- Node 18+ / npm

## Prerequisites
- PHP 8.1+ and Composer
- Node 18+ and npm
- MySQL database created and credentials ready

## Setup
```bash
git clone https://github.com/Parth2312430/SneakHub-Laravel.git
cd SneakHub-Laravel

cp .env.example .env    # set DB_*, APP_URL, etc.
composer install
npm install
php artisan key:generate

# build and seed
php artisan migrate --seed   # seeds MasterSeeder via DatabaseSeeder
npm run build

# serve
php artisan serve
```

Need a clean reset?
```bash
php artisan migrate:fresh --seed
npm run build
```

## Usage
- Public: `/` (welcome), `/shop`, `/product/{id}`, `/contact`
- Reviews: must be logged in; submit on product detail page
- Dark mode: toggle in navbar on the public site
- Admin (auth required):
	- `/admin/products`
	- `/admin/brands`
	- `/admin/categories`
	- AJAX search on products/brands; image previews on upload

Authentication: register/login normally. A sample user is seeded (`test@example.com`, password set by Laravel factory default: `password`).

## API Endpoints (public)
- `GET /api/products`
- `GET /api/products/{id}`
- `GET /api/categories`
- `GET /api/brands`

## Database & Seeding
- Migrations cover users, products, categories, brands, reviews, and supporting tables.
- `MasterSeeder` seeds 30 products with brands/categories plus sample reviews data structure ready.
- Run `php artisan migrate --seed` after configuring `.env`.

## Testing
No automated tests provided. You can run `php artisan test` to execute any you add.





