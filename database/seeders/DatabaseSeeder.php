<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin user
        User::firstOrCreate(
            ['email' => 'admin@techvault.com'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'is_admin' => 1]
        );

        // 2. CATEGORIES
        $accessory    = Category::create(['category_name' => 'Accessory']);
        $cables       = Category::create(['category_name' => 'Cables']);
        $dacAmp       = Category::create(['category_name' => 'DAC / Amp']);
        $dongleDac    = Category::create(['category_name' => 'Dongle DAC']);
        $earbuds      = Category::create(['category_name' => 'Earbuds / Wireless']);
        $earphones    = Category::create(['category_name' => 'Earphones (Wired)']);
        $eartips      = Category::create(['category_name' => 'Eartips']);
        $headphones   = Category::create(['category_name' => 'Headphones']);
        $iems         = Category::create(['category_name' => 'IEMs']);
        $keyboards    = Category::create(['category_name' => 'Keyboards']);
        $mice         = Category::create(['category_name' => 'Mice']);
        $monitors     = Category::create(['category_name' => 'Monitors']);
        $musicPlayers = Category::create(['category_name' => 'Music Players']);
        $speakers     = Category::create(['category_name' => 'Speakers']);

        // 3. PRODUCTS (Mapped with Tags for the Matcher Quiz)

        // ACCESSORY
        Product::create(['category_id' => $accessory->id, 'product_name' => 'Headphone Stand Aluminum', 'brand' => 'Sievert', 'description' => 'Solid aluminum single headphone stand with non-slip base.', 'price' => 29.99, 'stock_quantity' => 40, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);
        Product::create(['category_id' => $accessory->id, 'product_name' => 'Portable DAP Leather Case', 'brand' => 'Dignis', 'description' => 'Handcrafted genuine leather case for digital audio players.', 'price' => 45.00, 'stock_quantity' => 18, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $accessory->id, 'product_name' => 'IEM Storage Case Hard Shell', 'brand' => 'Pelican', 'description' => 'Hard shell carry case with customizable foam interior.', 'price' => 19.99, 'stock_quantity' => 55, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);
        Product::create(['category_id' => $accessory->id, 'product_name' => '3.5mm to 6.35mm Adapter', 'brand' => 'Nobunaga Labs', 'description' => 'Gold-plated 3.5mm TRS to 6.35mm TRS headphone adapter.', 'price' => 8.50, 'stock_quantity' => 100, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Producing,Budget']);

        // CABLES
        Product::create(['category_id' => $cables->id, 'product_name' => 'Effect Audio Ares S', 'brand' => 'Effect Audio', 'description' => '26AWG UP-OCC copper Litz cable.', 'price' => 89.00, 'stock_quantity' => 15, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $cables->id, 'product_name' => 'Kinera Gramr', 'brand' => 'Kinera', 'description' => 'High-purity silver-plated copper cable with 8-strand braid.', 'price' => 49.00, 'stock_quantity' => 22, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Casual']);
        Product::create(['category_id' => $cables->id, 'product_name' => 'Tripowin Zonie', 'brand' => 'Tripowin', 'description' => '16-core silver-plated OFC cable.', 'price' => 35.00, 'stock_quantity' => 30, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);
        Product::create(['category_id' => $cables->id, 'product_name' => 'DUNU DUW-02S Modular Cable', 'brand' => 'DUNU', 'description' => 'Modular MMCX cable with Quick-Switch plug system.', 'price' => 129.00, 'stock_quantity' => 10, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Gaming']);

        // DAC / AMP
        Product::create(['category_id' => $dacAmp->id, 'product_name' => 'Topping DX3 Pro+', 'brand' => 'Topping', 'description' => 'Desktop DAC/Amp combo with LDAC Bluetooth 5.0.', 'price' => 189.00, 'stock_quantity' => 12, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Gaming']);
        Product::create(['category_id' => $dacAmp->id, 'product_name' => 'FiiO K7', 'brand' => 'FiiO', 'description' => 'Balanced desktop DAC/Amp with dual AKM chips.', 'price' => 219.00, 'stock_quantity' => 8, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Gaming']);
        Product::create(['category_id' => $dacAmp->id, 'product_name' => 'SMSL SU-9 Ultra', 'brand' => 'SMSL', 'description' => 'Reference-grade desktop DAC using dual ES9039SPRO chips.', 'price' => 349.00, 'stock_quantity' => 5, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Premium']);
        Product::create(['category_id' => $dacAmp->id, 'product_name' => 'Schiit Magni Heresy', 'brand' => 'Schiit', 'description' => 'Fully discrete headphone amplifier.', 'price' => 109.00, 'stock_quantity' => 14, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);

        // DONGLE DAC
        Product::create(['category_id' => $dongleDac->id, 'product_name' => 'FiiO KA13', 'brand' => 'FiiO', 'description' => 'Dual CS43198 dongle DAC/amp with 4.4mm balanced output.', 'price' => 79.00, 'stock_quantity' => 25, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Gaming,Budget']);
        Product::create(['category_id' => $dongleDac->id, 'product_name' => 'Hidizs S9 Pro Plus', 'brand' => 'Hidizs', 'description' => 'ES9281AC Pro single chip dongle with balanced outputs.', 'price' => 69.00, 'stock_quantity' => 18, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);
        Product::create(['category_id' => $dongleDac->id, 'product_name' => 'Cayin RU7', 'brand' => 'Cayin', 'description' => 'Premium 1-bit DSD dongle DAC.', 'price' => 199.00, 'stock_quantity' => 7, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $dongleDac->id, 'product_name' => 'Apple USB-C Adapter', 'brand' => 'Apple', 'description' => 'Official Apple DAC adapter for USB-C devices.', 'price' => 12.00, 'stock_quantity' => 60, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);

        // EARBUDS / WIRELESS
        Product::create(['category_id' => $earbuds->id, 'product_name' => 'Sony WF-1000XM5', 'brand' => 'Sony', 'description' => 'Flagship TWS earbuds with industry-leading ANC.', 'price' => 279.99, 'stock_quantity' => 20, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Gaming']);
        Product::create(['category_id' => $earbuds->id, 'product_name' => 'Apple AirPods Pro 2', 'brand' => 'Apple', 'description' => 'H2 chip powered TWS with Adaptive Transparency.', 'price' => 249.00, 'stock_quantity' => 30, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Gaming']);
        Product::create(['category_id' => $earbuds->id, 'product_name' => 'Samsung Galaxy Buds3 Pro', 'brand' => 'Samsung', 'description' => 'ANC TWS earbuds with blade-type design.', 'price' => 229.99, 'stock_quantity' => 16, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Gaming']);
        Product::create(['category_id' => $earbuds->id, 'product_name' => 'Nothing Ear (2)', 'brand' => 'Nothing', 'description' => 'Transparent-design TWS with dual-driver setup.', 'price' => 149.00, 'stock_quantity' => 22, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Gaming']);

        // EARPHONES (WIRED)
        Product::create(['category_id' => $earphones->id, 'product_name' => 'Sennheiser IE 200', 'brand' => 'Sennheiser', 'description' => 'Audiophile wired earphone with TrueResponse transducer.', 'price' => 149.95, 'stock_quantity' => 14, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $earphones->id, 'product_name' => 'ATH-E70', 'brand' => 'Audio-Technica', 'description' => 'Professional in-ear monitor with triple drivers.', 'price' => 349.00, 'stock_quantity' => 6, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Premium']);
        Product::create(['category_id' => $earphones->id, 'product_name' => 'Shure SE215', 'brand' => 'Shure', 'description' => 'Sound-isolating earphone with single dynamic driver.', 'price' => 99.00, 'stock_quantity' => 25, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Gaming,Budget']);
        Product::create(['category_id' => $earphones->id, 'product_name' => 'Final Audio E3000', 'brand' => 'Final Audio', 'description' => 'Stainless steel body earphone with natural sound.', 'price' => 39.99, 'stock_quantity' => 35, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);

        // EARTIPS
        Product::create(['category_id' => $eartips->id, 'product_name' => 'SpinFit CP145', 'brand' => 'SpinFit', 'description' => 'Patented rotating eartips with dual-layer silicone.', 'price' => 14.99, 'stock_quantity' => 80, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);
        Product::create(['category_id' => $eartips->id, 'product_name' => 'Azla SednaEarfit', 'brand' => 'Azla', 'description' => 'Ultra-soft liquid silicone eartips.', 'price' => 19.99, 'stock_quantity' => 60, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $eartips->id, 'product_name' => 'Final Audio Type E', 'brand' => 'Final Audio', 'description' => 'Premium silicone eartips for comfort.', 'price' => 9.99, 'stock_quantity' => 100, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);
        Product::create(['category_id' => $eartips->id, 'product_name' => 'Comply Foam Tips', 'brand' => 'Comply', 'description' => 'Memory foam eartips for superior isolation.', 'price' => 17.99, 'stock_quantity' => 70, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);

        // HEADPHONES
        Product::create(['category_id' => $headphones->id, 'product_name' => 'Sony WH-1000XM5', 'brand' => 'Sony', 'description' => 'Over-ear ANC headphone with 30hr battery.', 'price' => 349.99, 'stock_quantity' => 18, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Gaming,Premium']);
        Product::create(['category_id' => $headphones->id, 'product_name' => 'Hifiman Sundara', 'brand' => 'Hifiman', 'description' => 'Planar magnetic open-back headphone.', 'price' => 299.00, 'stock_quantity' => 9, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Premium']);
        Product::create(['category_id' => $headphones->id, 'product_name' => 'Sennheiser HD 560S', 'brand' => 'Sennheiser', 'description' => 'Open-back audiophile headphone with neutral tuning.', 'price' => 199.95, 'stock_quantity' => 11, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $headphones->id, 'product_name' => 'Beyerdynamic DT 770 Pro', 'brand' => 'Beyerdynamic', 'description' => 'Closed-back studio headphone.', 'price' => 159.00, 'stock_quantity' => 20, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Gaming']);

        // KEYBOARDS
        Product::create(['category_id' => $keyboards->id, 'product_name' => 'Keychron Q1 Pro', 'brand' => 'Keychron', 'description' => 'Full aluminum 75% wireless mechanical keyboard.', 'price' => 199.00, 'stock_quantity' => 15, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $keyboards->id, 'product_name' => 'Logitech MX Keys S', 'brand' => 'Logitech', 'description' => 'Advanced wireless keyboard with smart illumination.', 'price' => 119.99, 'stock_quantity' => 22, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Producing']);
        Product::create(['category_id' => $keyboards->id, 'product_name' => 'Akko 5075B Plus', 'brand' => 'Akko', 'description' => '75% Bluetooth hot-swap keyboard.', 'price' => 89.99, 'stock_quantity' => 18, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Casual,Budget']);
        Product::create(['category_id' => $keyboards->id, 'product_name' => 'Ducky One 3 Mini', 'brand' => 'Ducky', 'description' => '60% hot-swap mechanical keyboard.', 'price' => 109.00, 'stock_quantity' => 0, 'product_image' => 'products/placeholder.jpg', 'status' => 'out_of_stock', 'tags' => 'Gaming,Casual']);

        // MICE
        Product::create(['category_id' => $mice->id, 'product_name' => 'G Pro X Superlight 2', 'brand' => 'Logitech', 'description' => 'Ultra-lightweight wireless gaming mouse.', 'price' => 159.99, 'stock_quantity' => 20, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Premium']);
        Product::create(['category_id' => $mice->id, 'product_name' => 'Razer Viper V3', 'brand' => 'Razer', 'description' => 'Asymmetric wireless gaming mouse.', 'price' => 79.99, 'stock_quantity' => 25, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Budget']);
        Product::create(['category_id' => $mice->id, 'product_name' => 'Glorious Model O 2', 'brand' => 'Glorious', 'description' => 'Honeycomb design wireless mouse.', 'price' => 89.99, 'stock_quantity' => 12, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Budget']);
        Product::create(['category_id' => $mice->id, 'product_name' => 'Pulsar X2V2', 'brand' => 'Pulsar', 'description' => 'Symmetrical ultra-light wireless mouse.', 'price' => 99.99, 'stock_quantity' => 10, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Casual']);

        // MONITORS
        Product::create(['category_id' => $monitors->id, 'product_name' => 'LG UltraGear 27GP850', 'brand' => 'LG', 'description' => '27" QHD 165Hz Nano IPS gaming monitor.', 'price' => 399.99, 'stock_quantity' => 7, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Producing,Premium']);
        Product::create(['category_id' => $monitors->id, 'product_name' => 'Samsung Odyssey G7', 'brand' => 'Samsung', 'description' => '32" 4K 144Hz QLED curved monitor.', 'price' => 699.99, 'stock_quantity' => 4, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Gaming,Premium']);
        Product::create(['category_id' => $monitors->id, 'product_name' => 'Dell UltraSharp U2723QE', 'brand' => 'Dell', 'description' => '27" 4K IPS Black professional monitor.', 'price' => 579.99, 'stock_quantity' => 6, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Premium']);
        Product::create(['category_id' => $monitors->id, 'product_name' => 'ASUS ROG Swift', 'brand' => 'ASUS', 'description' => '27" QHD 360Hz Fast IPS esports monitor.', 'price' => 849.99, 'stock_quantity' => 0, 'product_image' => 'products/placeholder.jpg', 'status' => 'out_of_stock', 'tags' => 'Gaming,Premium']);

        // MUSIC PLAYERS
        Product::create(['category_id' => $musicPlayers->id, 'product_name' => 'FiiO M11 Plus', 'brand' => 'FiiO', 'description' => 'Android-based DAP with dual AK4497EQ chips.', 'price' => 549.00, 'stock_quantity' => 8, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Premium']);
        Product::create(['category_id' => $musicPlayers->id, 'product_name' => 'Shanling M3 Ultra', 'brand' => 'Shanling', 'description' => 'Compact Android DAP with ES9219C chip.', 'price' => 329.00, 'stock_quantity' => 10, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Casual']);
        Product::create(['category_id' => $musicPlayers->id, 'product_name' => 'HiBy R6 Pro II', 'brand' => 'HiBy', 'description' => 'Dual ES9038Q2M flagship DAP.', 'price' => 699.00, 'stock_quantity' => 5, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Premium']);
        Product::create(['category_id' => $musicPlayers->id, 'product_name' => 'Sony NW-A306 Walkman', 'brand' => 'Sony', 'description' => 'Compact Android Walkman.', 'price' => 359.99, 'stock_quantity' => 12, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);

        // SPEAKERS
        Product::create(['category_id' => $speakers->id, 'product_name' => 'KEF LSX II', 'brand' => 'KEF', 'description' => 'Wireless HiFi bookshelf speakers.', 'price' => 1099.00, 'stock_quantity' => 5, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Producing,Premium']);
        Product::create(['category_id' => $speakers->id, 'product_name' => 'Edifier R1280DBs', 'brand' => 'Edifier', 'description' => 'Active bookshelf speaker.', 'price' => 139.99, 'stock_quantity' => 20, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Budget']);
        Product::create(['category_id' => $speakers->id, 'product_name' => 'JBL Charge 5', 'brand' => 'JBL', 'description' => 'Portable Bluetooth 5.1 speaker.', 'price' => 179.95, 'stock_quantity' => 28, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Gaming']);
        Product::create(['category_id' => $speakers->id, 'product_name' => 'Sonos Era 300', 'brand' => 'Sonos', 'description' => 'Spatial audio smart speaker.', 'price' => 449.00, 'stock_quantity' => 9, 'product_image' => 'products/placeholder.jpg', 'status' => 'available', 'tags' => 'Casual,Producing']);
    }
}