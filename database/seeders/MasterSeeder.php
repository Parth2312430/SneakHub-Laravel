<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CLEAR OLD DATA (Foreign key checks disabled to allow deletion)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Brand::truncate();
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. CREATE CATEGORIES
        $cat_lifestyle = Category::create(['name' => 'Lifestyle', 'description' => 'Casual wear for everyday comfort and style.']);
        $cat_running = Category::create(['name' => 'Running', 'description' => 'Performance footwear for track and road.']);
        $cat_basketball = Category::create(['name' => 'Basketball', 'description' => 'High-top support for the court.']);
        $cat_skate = Category::create(['name' => 'Skateboarding', 'description' => 'Durable flat soles for grip and board feel.']);

        // 3. CREATE BRANDS (Now with Logos)
        $brand_nike = Brand::create([
            'name' => 'Nike', 
            'logo' => 'brands/nike.png', 
            'description' => 'Just Do It.'
        ]);
        
        $brand_adidas = Brand::create([
            'name' => 'Adidas', 
            'logo' => 'brands/adidas.png', 
            'description' => 'Impossible is Nothing.'
        ]);
        
        $brand_puma = Brand::create([
            'name' => 'Puma', 
            'logo' => 'brands/puma.png', 
            'description' => 'Forever Faster.'
        ]);
        
        $brand_nb = Brand::create([
            'name' => 'New Balance', 
            'logo' => 'brands/nb.png', 
            'description' => 'Fearlessly Independent.'
        ]);
        
        $brand_vans = Brand::create([
            'name' => 'Vans', 
            'logo' => 'brands/vans.png', 
            'description' => 'Off The Wall.'
        ]);

        // 4. CREATE PRODUCTS (30 Items)
        
        // --- NIKE (7 Products) ---
        Product::create([
            'name' => 'Air Jordan 1 High "Chicago"',
            'brand' => 'Nike',
            'category' => 'Lifestyle',
            'price' => 45000,
            'stock' => 12,
            'image' => 'products/s1.jpg', 
            'description' => 'The sneaker that started it all. The Air Jordan 1 Retro High OG "Chicago" features the classic red, white, and black colorway. Premium leather construction ensures durability and style.'
        ]);

        Product::create([
            'name' => 'Nike Dunk Low "Panda"',
            'brand' => 'Nike',
            'category' => 'Skateboarding',
            'price' => 28000,
            'stock' => 25,
            'image' => 'products/s2.jpg',
            'description' => 'A street icon. The Nike Dunk Low Retro returns with crisp overlays and original team colors. This basketball icon channels 80s vibes with premium leather in the upper that looks good and breaks in even better.'
        ]);

        Product::create([
            'name' => 'Air Max 90 "Infrared"',
            'brand' => 'Nike',
            'category' => 'Running',
            'price' => 32000,
            'stock' => 18,
            'image' => 'products/s3.jpg',
            'description' => 'Nothing as fly, nothing as comfortable, nothing as proven. The Nike Air Max 90 stays true to its OG running roots with the iconic Waffle sole, stitched overlays and classic TPU accents.'
        ]);

        Product::create([
            'name' => 'Air Force 1 Low "Triple White"',
            'brand' => 'Nike',
            'category' => 'Lifestyle',
            'price' => 25000,
            'stock' => 50,
            'image' => 'products/s13.jpg',
            'description' => 'The radiance lives on in the Nike Air Force 1, the b-ball OG that puts a fresh spin on what you know best: crisp leather, bold colors and the perfect amount of flash to make you shine.'
        ]);

        Product::create([
            'name' => 'Nike Blazer Mid 77 Vintage',
            'brand' => 'Nike',
            'category' => 'Lifestyle',
            'price' => 22000,
            'stock' => 30,
            'image' => 'products/s14.jpg',
            'description' => 'In the ‘70s, Nike was the new shoe on the block. So new in fact, we were still breaking into the basketball scene and testing prototypes on the feet of our local team. Of course, the design improved over the years.'
        ]);

         Product::create([
            'name' => 'Nike SB Dunk Low Pro',
            'brand' => 'Nike',
            'category' => 'Skateboarding',
            'price' => 30000,
            'stock' => 15,
            'image' => 'products/s15.jpg',
            'description' => 'The Nike SB Dunk Low Pro delivers iconic Dunk style in a low-cut silhouette. A Zoom Air unit in the heel and a padded tongue provide a comfortable fit that’s made to skate.'
        ]);

         Product::create([
            'name' => 'LeBron XX "Time Machine"',
            'brand' => 'Nike',
            'category' => 'Basketball',
            'price' => 50000,
            'stock' => 8,
            'image' => 'products/s16.jpg',
            'description' => 'Two decades of a career that’s exceeded every lofty expectation, LeBron James has refused to settle for anything less than greatness. The LeBron XX is the lightest, lowest-to-the-ground, most turbo-like, ultra-modern machine.'
        ]);


        // --- ADIDAS (6 Products) ---
        Product::create([
            'name' => 'Yeezy Boost 350 V2 "Zebra"',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'price' => 55000,
            'stock' => 8,
            'image' => 'products/s4.jpg',
            'description' => 'The Yeezy Boost 350 V2 features an upper composed of re-engineered Primeknit. The post-dyed monofilament side stripe is woven into the upper. The midsole utilizes adidas innovative BOOST technology.'
        ]);

        Product::create([
            'name' => 'Adidas Samba OG',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'price' => 22000,
            'stock' => 30,
            'image' => 'products/s5.jpg',
            'description' => 'Born on the pitch, the Samba is a timeless icon of street style. This silhouette stays true to its legacy with a tasteful, low-profile, soft leather upper, suede overlays and gum sole.'
        ]);

        Product::create([
            'name' => 'Ultraboost Light',
            'brand' => 'Adidas',
            'category' => 'Running',
            'price' => 38000,
            'stock' => 15,
            'image' => 'products/s6.jpg',
            'description' => 'Experience epic energy. The lightest Ultraboost ever, made with 30% lighter BOOST material. Each tiny capsule within the midsole works together to deliver epic energy in every stride.'
        ]);

        Product::create([
            'name' => 'Adidas Forum Low',
            'brand' => 'Adidas',
            'category' => 'Basketball',
            'price' => 24000,
            'stock' => 20,
            'image' => 'products/s17.jpg',
            'description' => 'More than just a shoe, it\'s a statement. The adidas Forum hit the scene in \'84 and gained major love on both the hardwood and in the music biz. This pair of the classic shoes brings back the \'80s attitude.'
        ]);

        Product::create([
            'name' => 'Adidas Gazelle',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'price' => 21000,
            'stock' => 25,
            'image' => 'products/s18.jpg',
            'description' => 'From the \'60s to today, the beloved adidas Gazelle shoes have gone through many different iterations. This modern version throws it back to their second coming in 1991, a time when you could find them in a sea of soccer fans.'
        ]);

        Product::create([
            'name' => 'Stan Smith',
            'brand' => 'Adidas',
            'category' => 'Lifestyle',
            'price' => 20000,
            'stock' => 40,
            'image' => 'products/s19.jpg',
            'description' => 'Timeless appeal. Effortless style. Everyday versatility. For over 50 years and counting, adidas Stan Smith Shoes have continued to hold their place as an icon. This pair shows off a fresh redesign.'
        ]);


        // --- NEW BALANCE (6 Products) ---
        Product::create([
            'name' => 'New Balance 550 "White/Green"',
            'brand' => 'New Balance',
            'category' => 'Basketball',
            'price' => 26000,
            'stock' => 20,
            'image' => 'products/s7.jpg',
            'description' => 'The 550 debut in 1989 left its mark on basketball courts from coast to coast. After its initial run, the 550 was filed away in the archives, before being reintroduced in limited-edition releases in late 2020.'
        ]);

        Product::create([
            'name' => 'New Balance 9060',
            'brand' => 'New Balance',
            'category' => 'Lifestyle',
            'price' => 34000,
            'stock' => 10,
            'image' => 'products/s8.jpg',
            'description' => 'The 9060 is a new expression of the refined style and innovation-led design that have made the 99X series home to some of the most iconic models in New Balance history.'
        ]);

        Product::create([
            'name' => 'New Balance 2002R',
            'brand' => 'New Balance',
            'category' => 'Running',
            'price' => 30000,
            'stock' => 15,
            'image' => 'products/s20.jpg',
            'description' => 'The 2002R men\'s sneaker proves that slick kicks can still be comfortable. The suede and mesh upper is inspired by running shoes from the 2000s for a retro-meets-modern aesthetic.'
        ]);

         Product::create([
            'name' => 'New Balance 327',
            'brand' => 'New Balance',
            'category' => 'Lifestyle',
            'price' => 23000,
            'stock' => 22,
            'image' => 'products/s21.jpg',
            'description' => 'As recreational running established widespread popularity in the 1970s, the benchmark for running footwear shifted from mere existence to performance. The 327 sheds new light on the ‘70s as a time of innovation.'
        ]);

         Product::create([
            'name' => 'New Balance 530',
            'brand' => 'New Balance',
            'category' => 'Running',
            'price' => 25000,
            'stock' => 18,
            'image' => 'products/s22.jpg',
            'description' => 'The 530 men’s sneaker is a throwback of one of our classic running shoes. This casual kick combines everyday style with modern tech.'
        ]);

         Product::create([
            'name' => 'New Balance 574 Core',
            'brand' => 'New Balance',
            'category' => 'Lifestyle',
            'price' => 19000,
            'stock' => 35,
            'image' => 'products/s23.jpg',
            'description' => 'The 574 was built to be a reliable shoe that could do a lot of different things well rather than as a platform for revolutionary technology, or as a premium materials showcase.'
        ]);


        // --- PUMA (5 Products) ---
        Product::create([
            'name' => 'Puma Suede Classic XXI',
            'brand' => 'Puma',
            'category' => 'Lifestyle',
            'price' => 18000,
            'stock' => 40,
            'image' => 'products/s9.jpg',
            'description' => 'The Suede hit the scene in 1968 and has been changing the game ever since. From Tommie Smith’s podium protest to the b-boy crews in NYC during the 80s, it’s worn by the icons of every generation.'
        ]);

        Product::create([
            'name' => 'LaMelo Ball MB.03',
            'brand' => 'Puma',
            'category' => 'Basketball',
            'price' => 42000,
            'stock' => 5,
            'image' => 'products/s10.jpg',
            'description' => 'MB.03, LaMelo Ball’s third signature sneaker, takes a trip to the never-before-seen alternative universe that is the Melo world. Highlighted by slime-inspired rubber wrap-ups and an engineered knit upper.'
        ]);

        Product::create([
            'name' => 'Puma RS-X Efekt',
            'brand' => 'Puma',
            'category' => 'Lifestyle',
            'price' => 28000,
            'stock' => 12,
            'image' => 'products/s24.jpg',
            'description' => 'The RS-X is back. The future-retro silhouette of this sneaker returns with a progressive aesthetic and angular details, complete with nubuck and suede overlays.'
        ]);

        Product::create([
            'name' => 'Puma Cali Dream',
            'brand' => 'Puma',
            'category' => 'Lifestyle',
            'price' => 21000,
            'stock' => 20,
            'image' => 'products/s25.jpg',
            'description' => 'These kicks are ready to shine. With a chunky sole and a relaxed West Coast vibe, the Cali Dream is here to make a statement.'
        ]);

        Product::create([
            'name' => 'Puma Palermo',
            'brand' => 'Puma',
            'category' => 'Lifestyle',
            'price' => 23000,
            'stock' => 15,
            'image' => 'products/s26.jpg',
            'description' => 'Back from the archives, the Palermo is a terrace legend. This silhouette debuted in early \'80s football stadiums, where it was a staple among the terrace crowd.'
        ]);


        // --- VANS (6 Products) ---
        Product::create([
            'name' => 'Vans Old Skool',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'price' => 15000,
            'stock' => 50,
            'image' => 'products/s11.jpg',
            'description' => 'The Old Skool was our first footwear design to showcase the famous Vans Sidestripe—although back then, it was just a simple doodle drawn by founder Paul Van Doren.'
        ]);

        Product::create([
            'name' => 'Vans Sk8-Hi',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'price' => 17000,
            'stock' => 35,
            'image' => 'products/s12.jpg',
            'description' => 'The Sk8-Hi was introduced in 1978 as the Style 38, and showcased the now-iconic Vans Sidestripe on a new, innovative high top silhouette.'
        ]);

        Product::create([
            'name' => 'Vans Authentic',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'price' => 13000,
            'stock' => 60,
            'image' => 'products/s27.jpg',
            'description' => 'Born in Anaheim, California in 1966, the Authentic is the original Vans heritage style. Originally known as Vans #44 Deck Shoes, the Authentic became an immediate cult icon.'
        ]);

        Product::create([
            'name' => 'Vans Slip-On Checkerboard',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'price' => 14000,
            'stock' => 45,
            'image' => 'products/s28.jpg',
            'description' => 'First introduced in 1977, the Vans #98—now known as the Classic Slip-On—instantly became an icon in Southern California.'
        ]);

        Product::create([
            'name' => 'Vans Era',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'price' => 14500,
            'stock' => 40,
            'image' => 'products/s29.jpg',
            'description' => 'The Era, originally called the Vans #95, was brought to life in 1976 and made popular by the legendary Z-Boys of Santa Monica.'
        ]);

         Product::create([
            'name' => 'Vans Knu Skool',
            'brand' => 'Vans',
            'category' => 'Skateboarding',
            'price' => 18000,
            'stock' => 20,
            'image' => 'products/s30.jpg',
            'description' => 'The Knu Skool is a modern interpretation of a classic 90s style, defined by its puffed up tongue and 3D molded Sidestripe, and tied off with oversized chunky laces.'
        ]);
    }
}