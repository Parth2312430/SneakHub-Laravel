<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Import your Product model
use Illuminate\Support\Facades\DB; // Import the DB facade

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Clear the table first to avoid duplicates
        DB::table('products')->delete();

        // 2. Create the 30 products

        // 1
        Product::create([
            'name' => 'Nike Air Jordan 1 "Chicago"',
            'brand' => 'Nike',
            'category' => 'Lifestyle',
            'description' => 'The most iconic colorway of the most iconic shoe.',
            'price' => 48000.00,
            'image' => 'images/sneaker-01.jpg',
            'stock' => 15
        ]);

        // 2
        Product::create([
            'name' => 'Adidas Yeezy 350 "Zebra"',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'description' => 'The popular "Zebra" Primeknit pattern with a Boost sole.',
            'price' => 45000.00,
            'image' => 'images/sneaker-02.jpg',
            'stock' => 18
        ]);

        // 3
        Product::create([
            'name' => 'New Balance 550 "White Green"',
            'brand' => 'New Balance',
            'category' => 'Retro',
            'description' => 'A retro basketball shoe. Simple, clean, and stylish.',
            'price' => 22000.00,
            'image' => 'images/sneaker-03.jpg',
            'stock' => 30
        ]);

        // 4
        Product::create([
            'name' => 'Nike Dunk Low "Panda"',
            'brand' => 'Nike',
            'category' => 'Skateboarding',
            'description' => 'The classic black and white colorway. Goes with everything.',
            'price' => 28500.00,
            'image' => 'images/sneaker-04.jpg',
            'stock' => 25
        ]);

        // 5
        Product::create([
            'name' => 'Converse Chuck 70 Hi "Black"',
            'brand' => 'Converse',
            'category' => 'Lifestyle',
            'description' => 'A timeless high-top with a durable canvas upper.',
            'price' => 15000.00,
            'image' => 'images/sneaker-05.jpg',
            'stock' => 40
        ]);

        // 6
        Product::create([
            'name' => 'Vans Old Skool "Black/White"',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'description' => 'The original skate shoe with the iconic sidestripe.',
            'price' => 12000.00,
            'image' => 'images/sneaker-06.jpg',
            'stock' => 50
        ]);

        // 7
        Product::create([
            'name' => 'Puma Suede Classic "Red"',
            'brand' => 'Puma',
            'category' => 'Lifestyle',
            'description' => 'A stylish low-top with a full suede upper in a vibrant red.',
            'price' => 14500.00,
            'image' => 'images/sneaker-07.jpg',
            'stock' => 35
        ]);

        // 8
        Product::create([
            'name' => 'Asics Gel-Lyte III "OG"',
            'brand' => 'Asics',
            'category' => 'Running',
            'description' => 'Known for its unique split-tongue design and comfort.',
            'price' => 19000.00,
            'image' => 'images/sneaker-08.jpg',
            'stock' => 22
        ]);

        // 9
        Product::create([
            'name' => 'Reebok Club C 85 "Vintage"',
            'brand' => 'Reebok',
            'category' => 'Retro',
            'description' => 'A minimal leather tennis shoe with a soft terry lining.',
            'price' => 16000.00,
            'image' => 'images/sneaker-09.jpg',
            'stock' => 30
        ]);

        // 10
        Product::create([
            'name' => 'Nike Air Force 1 "Triple White"',
            'brand' => 'Nike',
            'category' => 'Lifestyle',
            'description' => 'The all-time best-selling sneaker. A must-have.',
            'price' => 24000.00,
            'image' => 'images/sneaker-10.jpg',
            'stock' => 50
        ]);

        // 11
        Product::create([
            'name' => 'Adidas Samba OG "White/Black"',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'description' => 'A classic indoor soccer shoe, now a fashion staple.',
            'price' => 21000.00,
            'image' => 'images/sneaker-11.jpg',
            'stock' => 30 // <-- TYPO FIX 1
        ]);

        // 12
        Product::create([
            'name' => 'Nike Air Max 90 "Infrared"',
            'brand' => 'Nike',
            'category' => 'Running',
            'description' => 'The OG colorway of the iconic Air Max 90 with a visible Air unit.',
            'price' => 27000.00,
            'image' => 'images/sneaker-12.jpg',
            'stock' => 20
        ]);

        // 13
        Product::create([
            'name' => 'New Balance 990v5 "Grey"',
            'brand' => 'New Balance',
            'category' => 'Running',
            'description' => 'Premium suede and mesh, made in the USA.',
            'price' => 38000.00,
            'image' => 'images/sneaker-13.jpg',
            'stock' => 15
        ]);

        // 14
        Product::create([
            'name' => 'Air Jordan 4 "Bred"',
            'brand' => 'Nike',
            'category' => 'Retro',
            'description' => 'The iconic black and red colorway of the Jordan 4.',
            'price' => 42000.00,
            'image' => 'images/sneaker-14.jpg',
            'stock' => 12
        ]);

        // 15
        Product::create([
            'name' => 'Adidas Superstar "White/Black"',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'description' => 'The classic shell-toe, a hip-hop and fashion icon.',
            'price' => 18000.00,
            'image' => 'images/sneaker-15.jpg',
            'stock' => 35
        ]);

        // 16
        Product::create([
            'name' => 'Nike Blazer Mid 77 "Vintage"',
            'brand' => 'Nike',
            'category' => 'Retro',
            'description' => 'A retro high-top basketball shoe with a clean, simple design.',
            'price' => 21000.00,
            'image' => 'images/sneaker-16.jpg',
            'stock' => 28
        ]);

        // 17
        Product::create([
            'name' => 'Yeezy Foam Runner "Onyx"',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'description' => 'A controversial but comfortable foam clog in all-black.',
            'price' => 25000.00,
            'image' => 'images/sneaker-17.jpg',
            'stock' => 20
        ]);

        // 18
        Product::create([
            'name' => 'Salomon XT-6 "Black"',
            'brand' => 'Salomon',
            'category' => 'Running',
            'description' => 'A high-performance trail runner that became a fashion favorite.',
            'price' => 31000.00,
            'image' => 'images/sneaker-18.jpg',
            'stock' => 18
        ]);

        // 19
        Product::create([
            'name' => 'Nike Air Max 97 "Silver Bullet"',
            'brand' => 'Nike',
            'category' => 'Running',
            'description' => 'Inspired by the Japanese bullet train. A futuristic design.',
            'price' => 29000.00,
            'image' => 'images/sneaker-19.jpg',
            'stock' => 20
        ]);

        // 20
        Product::create([
            'name' => 'Air Jordan 11 "Concord"',
            'brand' => 'Nike',
            'category' => 'Retro',
            'description' => 'The famous patent leather design worn by Michael Jordan.',
            'price' => 50000.00,
            'image' => 'images/sneaker-20.jpg',
            'stock' => 10
        ]);

        // 21
        Product::create([
            'name' => 'Adidas Gazelle "Indoor Blue"',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'description' => 'A slim, low-profile sneaker with a gum sole.',
            'price' => 17500.00,
            'image' => 'images/sneaker-21.jpg',
            'stock' => 25
        ]);

        // 22
        Product::create([
            'name' => 'Nike Zoom Vomero 5 "Anthracite"',
            'brand' => 'Nike',
            'category' => 'Running',
            'description' => 'A modern retro runner with layered mesh and techy details.',
            'price' => 26500.00,
            'image' => 'images/sneaker-22.jpg',
            'stock' => 20
        ]);

        // 23
        Product::create([
            'name' => 'New Balance 2002R "Protection Pack"',
            'brand' => 'New Balance',
            'category' => 'Lifestyle',
            'description' => 'A deconstructed, stylish take on a modern running shoe.',
            'price' => 33000.00,
            'image' => 'images/sneaker-23.jpg',
            'stock' => 15
        ]);

        // 24
        Product::create([
            'name' => 'Vans Knu Skool "Black/White"',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'description' => 'A 90s-inspired chunky skate shoe with a puffed-up tongue.',
            'price' => 14000.00,
            'image' => 'images/sneaker-24.jpg',
            'stock' => 30
        ]);

        // 25
        Product::create([
            'name' => 'On Cloud 5 "All Black"',
            'brand' => 'On',
            'category' => 'Running',
            'description' => 'Ultra-lightweight running shoe with CloudTec cushioning.',
            'price' => 23000.00,
            'image' => 'images/sneaker-25.jpg',
            'stock' => 25
        ]);

        // 26
        Product::create([
            'name' => 'Nike Air Jordan 3 "White Cement"',
            'brand' => 'Nike',
            'category' => 'Retro',
            'description' => 'The shoe that saved the Jordan line, with iconic elephant print.',
            'price' => 40000.00,
            'image' => 'images/sneaker-26.jpg',
            'stock' => 15
        ]);

        // 27
        Product::create([
            'name' => 'Adidas Campus 00s "Black"',
            'brand' => 'Adidas',
            'category' => 'Skateboarding',
            'description' => 'A chunky, 2000s-inspired take on the classic Campus.',
            'price' => 19500.00,
            'image' => 'images/sneaker-27.jpg',
            'stock' => 28
        ]);

        // 28
        Product::create([
            'name' => 'Hoka Clifton 9 "Black/White"',
            'brand' => 'Hoka',
            'category' => 'Running',
            'description' => 'Maximum cushion running shoe for everyday miles.',
            'price' => 25000.00,
            'image' => 'images/sneaker-28.jpg',
            'stock' => 20
        ]);

        // 29
        Product::create([
            'name' => 'Birkenstock Boston "Taupe Suede"',
            'brand' => 'Birkenstock',
            'category' => 'Lifestyle', // <-- TYPO FIX 2
            'description' => 'A comfortable suede clog with a cork footbed.',
            'price' => 28000.00,
            'image' => 'images/sneaker-29.jpg',
            'stock' => 18
        ]);

        // 30
        Product::create([
            'name' => 'Crocs Classic Clog "White"',
            'brand' => 'Crocs',
            'category' => 'Lifestyle',
            'description' => 'The iconic, lightweight, and versatile clog.',
            'price' => 9000.00,
            'image' => 'images/sneaker-30.jpg',
            'stock' => 50
        ]);
    }
}