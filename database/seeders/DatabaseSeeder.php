<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@overclockhub.com',
            'password' => 'Admin@OC2025',
        ]);
        $admin->forceFill(['role' => 'admin'])->save();

        // Regular test user
        User::create([
            'name' => 'TestUser',
            'email' => 'user@overclockhub.com',
            'password' => 'User@OC2025',
        ]);

        // Vouchers
        Voucher::create([
            'code' => 'OC500',
            'discount_amount' => 500,
            'min_order_amount' => 2000,
            'is_active' => true,
            'max_uses' => 100,
            'times_used' => 0,
            'expires_at' => now()->addMonths(6),
        ]);
        Voucher::create([
            'code' => 'WELCOME100',
            'discount_amount' => 100,
            'min_order_amount' => 500,
            'is_active' => true,
            'max_uses' => 500,
            'times_used' => 0,
            'expires_at' => now()->addYear(),
        ]);

        // Categories
        $categories = [
            ['name' => 'Processors',    'slug' => 'cpu',      'group_name' => 'Core',            'image_class' => 'cpu'],
            ['name' => 'Graphics',      'slug' => 'gpu',      'group_name' => 'Core',            'image_class' => 'gpu'],
            ['name' => 'Motherboards',  'slug' => 'mobo',     'group_name' => 'Core',            'image_class' => 'mobo'],
            ['name' => 'Memory',        'slug' => 'ram',      'group_name' => 'Core',            'image_class' => 'ram'],
            ['name' => 'NVMe SSD',      'slug' => 'ssd',      'group_name' => 'Storage',         'image_class' => 'ssd'],
            ['name' => 'Enterprise HDD','slug' => 'hdd',      'group_name' => 'Storage',         'image_class' => 'hdd'],
            ['name' => 'Power Supplies','slug' => 'psu',      'group_name' => 'Power & Cooling', 'image_class' => 'psu'],
            ['name' => 'CPU Coolers',   'slug' => 'cooler',   'group_name' => 'Power & Cooling', 'image_class' => 'cooler'],
            ['name' => 'Case Fans',     'slug' => 'fans',     'group_name' => 'Power & Cooling', 'image_class' => 'fans'],
            ['name' => 'PC Cases',      'slug' => 'case',     'group_name' => 'Build & Gear',    'image_class' => 'case'],
            ['name' => 'Monitors',      'slug' => 'monitor',  'group_name' => 'Build & Gear',    'image_class' => 'monitor'],
            ['name' => 'Keyboards',     'slug' => 'keyboard', 'group_name' => 'Build & Gear',    'image_class' => 'key'],
            ['name' => 'Mice',          'slug' => 'mouse',    'group_name' => 'Build & Gear',    'image_class' => 'mouse'],
            ['name' => 'Headsets',      'slug' => 'audio',    'group_name' => 'Build & Gear',    'image_class' => 'audio'],
        ];

        $catMap = [];
        foreach ($categories as $cat) {
            $catMap[$cat['slug']] = Category::create($cat)->id;
        }

        // All 112 products
        $products = [
            // CPU (8)
            ['c'=>'cpu','n'=>'Intel Core i9-14900KS Special Edition','p'=>3599.00,'i'=>'CPU'],
            ['c'=>'cpu','n'=>'Intel Core i9-14900K 6.0GHz','p'=>2899.00,'i'=>'CPU'],
            ['c'=>'cpu','n'=>'Intel Core i7-14700K 5.6GHz','p'=>2050.00,'i'=>'CPU'],
            ['c'=>'cpu','n'=>'Intel Core Ultra 9 285K','p'=>2999.00,'i'=>'CPU'],
            ['c'=>'cpu','n'=>'AMD Ryzen 9 7950X3D','p'=>3299.00,'i'=>'CPU'],
            ['c'=>'cpu','n'=>'AMD Ryzen 9 7950X','p'=>2799.00,'i'=>'CPU'],
            ['c'=>'cpu','n'=>'AMD Ryzen 9 9950X','p'=>3199.00,'i'=>'CPU'],
            ['c'=>'cpu','n'=>'AMD Ryzen 7 7800X3D','p'=>1899.00,'i'=>'CPU'],
            // GPU (8)
            ['c'=>'gpu','n'=>'ASUS ROG Matrix RTX 4090','p'=>16999.00,'i'=>'GPU'],
            ['c'=>'gpu','n'=>'MSI SUPRIM Liquid X RTX 4090','p'=>10499.00,'i'=>'GPU'],
            ['c'=>'gpu','n'=>'NVIDIA RTX 4080 Super FE','p'=>4999.00,'i'=>'GPU'],
            ['c'=>'gpu','n'=>'Gigabyte AORUS Master RTX 4080S','p'=>5899.00,'i'=>'GPU'],
            ['c'=>'gpu','n'=>'ASUS ROG Strix RTX 4070 TiS','p'=>4699.00,'i'=>'GPU'],
            ['c'=>'gpu','n'=>'Sapphire NITRO+ RX 7900 XTX','p'=>5499.00,'i'=>'GPU'],
            ['c'=>'gpu','n'=>'PowerColor Red Devil 7900 XTX','p'=>5299.00,'i'=>'GPU'],
            ['c'=>'gpu','n'=>'XFX Speedster MERC310 7900 XT','p'=>3999.00,'i'=>'GPU'],
            // MOBO (8)
            ['c'=>'mobo','n'=>'ASUS ROG Maximus Z790 Extreme','p'=>5299.00,'i'=>'MOBO'],
            ['c'=>'mobo','n'=>'MSI MEG Z790 GODLIKE MAX','p'=>6299.00,'i'=>'MOBO'],
            ['c'=>'mobo','n'=>'Gigabyte Z790 AORUS Master','p'=>2899.00,'i'=>'MOBO'],
            ['c'=>'mobo','n'=>'ASUS ProArt Z790-Creator','p'=>2199.00,'i'=>'MOBO'],
            ['c'=>'mobo','n'=>'ASUS ROG Crosshair X670E Ext','p'=>4899.00,'i'=>'MOBO'],
            ['c'=>'mobo','n'=>'MSI MEG X670E ACE','p'=>3499.00,'i'=>'MOBO'],
            ['c'=>'mobo','n'=>'ASRock X670E Taichi','p'=>2699.00,'i'=>'MOBO'],
            ['c'=>'mobo','n'=>'Gigabyte X670E AORUS XTREME','p'=>3299.00,'i'=>'MOBO'],
            // RAM (8)
            ['c'=>'ram','n'=>'G.Skill Trident Z5 Royal 96GB','p'=>2199.00,'i'=>'RAM'],
            ['c'=>'ram','n'=>'Corsair Dominator Titanium 64GB','p'=>1899.00,'i'=>'RAM'],
            ['c'=>'ram','n'=>'TeamGroup T-Force Delta 64GB','p'=>1699.00,'i'=>'RAM'],
            ['c'=>'ram','n'=>'Kingston FURY Renegade 64GB','p'=>1599.00,'i'=>'RAM'],
            ['c'=>'ram','n'=>'Corsair Vengeance RGB 96GB','p'=>1950.00,'i'=>'RAM'],
            ['c'=>'ram','n'=>'G.Skill Flare X5 64GB','p'=>1199.00,'i'=>'RAM'],
            ['c'=>'ram','n'=>'TeamGroup XTREEM ARGB 48GB','p'=>1499.00,'i'=>'RAM'],
            ['c'=>'ram','n'=>'Crucial Pro Overclocking 64GB','p'=>1099.00,'i'=>'RAM'],
            // SSD (8)
            ['c'=>'ssd','n'=>'Crucial T705 4TB PCIe Gen5','p'=>2850.00,'i'=>'SSD'],
            ['c'=>'ssd','n'=>'Corsair MP700 PRO 2TB Gen5','p'=>1599.00,'i'=>'SSD'],
            ['c'=>'ssd','n'=>'Samsung 990 PRO 4TB Gen4','p'=>1799.00,'i'=>'SSD'],
            ['c'=>'ssd','n'=>'WD Black SN850X 4TB','p'=>1699.00,'i'=>'SSD'],
            ['c'=>'ssd','n'=>'WD Black SN850X 8TB','p'=>3899.00,'i'=>'SSD'],
            ['c'=>'ssd','n'=>'Seagate FireCuda 540 2TB','p'=>1450.00,'i'=>'SSD'],
            ['c'=>'ssd','n'=>'Kingston KC3000 4TB','p'=>1550.00,'i'=>'SSD'],
            ['c'=>'ssd','n'=>'Sabrent Rocket 4 Plus-G 4TB','p'=>1850.00,'i'=>'SSD'],
            // HDD (8)
            ['c'=>'hdd','n'=>'WD Gold Enterprise 24TB','p'=>2899.00,'i'=>'HDD'],
            ['c'=>'hdd','n'=>'Seagate Exos X24 24TB','p'=>2750.00,'i'=>'HDD'],
            ['c'=>'hdd','n'=>'WD Black 10TB','p'=>1499.00,'i'=>'HDD'],
            ['c'=>'hdd','n'=>'Seagate IronWolf Pro 24TB','p'=>2899.00,'i'=>'HDD'],
            ['c'=>'hdd','n'=>'Seagate IronWolf Pro 22TB','p'=>2499.00,'i'=>'HDD'],
            ['c'=>'hdd','n'=>'Toshiba MG10 Series 20TB','p'=>2199.00,'i'=>'HDD'],
            ['c'=>'hdd','n'=>'WD Red Pro 22TB','p'=>2599.00,'i'=>'HDD'],
            ['c'=>'hdd','n'=>'WD Purple Pro 22TB','p'=>2650.00,'i'=>'HDD'],
            // PSU (8)
            ['c'=>'psu','n'=>'Corsair AX1600i Titanium','p'=>2699.00,'i'=>'PSU'],
            ['c'=>'psu','n'=>'Seasonic PRIME TX-1600','p'=>2499.00,'i'=>'PSU'],
            ['c'=>'psu','n'=>'ASUS ROG Thor 1600W','p'=>2899.00,'i'=>'PSU'],
            ['c'=>'psu','n'=>'be quiet! Dark Power Pro 13','p'=>2399.00,'i'=>'PSU'],
            ['c'=>'psu','n'=>'EVGA SuperNOVA 1600 T2','p'=>2599.00,'i'=>'PSU'],
            ['c'=>'psu','n'=>'MSI MEG Ai1300P PCIE5','p'=>1599.00,'i'=>'PSU'],
            ['c'=>'psu','n'=>'Thermaltake Toughpower GF3','p'=>1799.00,'i'=>'PSU'],
            ['c'=>'psu','n'=>'FSP Hydro Ti PRO 1000W','p'=>1299.00,'i'=>'PSU'],
            // Cooler (8)
            ['c'=>'cooler','n'=>'ASUS ROG Ryujin III 360','p'=>1899.00,'i'=>'AIO'],
            ['c'=>'cooler','n'=>'Corsair iCUE LINK H170i','p'=>1699.00,'i'=>'AIO'],
            ['c'=>'cooler','n'=>'Corsair iCUE LINK H150i','p'=>1499.00,'i'=>'AIO'],
            ['c'=>'cooler','n'=>'NZXT Kraken Elite 360','p'=>1399.00,'i'=>'AIO'],
            ['c'=>'cooler','n'=>'Lian Li Galahad II LCD 360','p'=>1299.00,'i'=>'AIO'],
            ['c'=>'cooler','n'=>'Phanteks Glacier One 360','p'=>1199.00,'i'=>'AIO'],
            ['c'=>'cooler','n'=>'Arctic Liquid Freezer III 420','p'=>699.00,'i'=>'AIO'],
            ['c'=>'cooler','n'=>'Noctua NH-D15 chromax','p'=>599.00,'i'=>'AIR'],
            // Fans (8)
            ['c'=>'fans','n'=>'Lian Li UNI FAN TL LCD (3-Pk)','p'=>699.00,'i'=>'FAN'],
            ['c'=>'fans','n'=>'Corsair iCUE LINK QX120 (3-Pk)','p'=>650.00,'i'=>'FAN'],
            ['c'=>'fans','n'=>'Thermaltake SWAFAN EX12 (3-Pk)','p'=>599.00,'i'=>'FAN'],
            ['c'=>'fans','n'=>'Phanteks D30-140 (3-Pk)','p'=>450.00,'i'=>'FAN'],
            ['c'=>'fans','n'=>'Lian Li UNI FAN AL120 (3-Pk)','p'=>420.00,'i'=>'FAN'],
            ['c'=>'fans','n'=>'NZXT F120 RGB Core (3-Pk)','p'=>350.00,'i'=>'FAN'],
            ['c'=>'fans','n'=>'Noctua NF-A12x25 chromax','p'=>159.00,'i'=>'FAN'],
            ['c'=>'fans','n'=>'be quiet! Silent Wings Pro 4','p'=>149.00,'i'=>'FAN'],
            // Case (8)
            ['c'=>'case','n'=>'Lian Li V3000 PLUS','p'=>2499.00,'i'=>'CASE'],
            ['c'=>'case','n'=>'Corsair Obsidian 1000D','p'=>2899.00,'i'=>'CASE'],
            ['c'=>'case','n'=>'Cooler Master Cosmos C700M','p'=>2199.00,'i'=>'CASE'],
            ['c'=>'case','n'=>'ASUS ROG Hyperion GR701','p'=>1999.00,'i'=>'CASE'],
            ['c'=>'case','n'=>'HYTE Y70 Touch Infinite','p'=>1899.00,'i'=>'CASE'],
            ['c'=>'case','n'=>'be quiet! Dark Base Pro 901','p'=>1499.00,'i'=>'CASE'],
            ['c'=>'case','n'=>'Phanteks NV9 Premium','p'=>1299.00,'i'=>'CASE'],
            ['c'=>'case','n'=>'Fractal Design Torrent','p'=>1199.00,'i'=>'CASE'],
            // Monitor (8)
            ['c'=>'monitor','n'=>'Samsung Odyssey OLED G9','p'=>8999.00,'i'=>'MON'],
            ['c'=>'monitor','n'=>'LG UltraGear OLED 45GR','p'=>6999.00,'i'=>'MON'],
            ['c'=>'monitor','n'=>'ASUS ROG Swift OLED PG32','p'=>6899.00,'i'=>'MON'],
            ['c'=>'monitor','n'=>'Gigabyte AORUS FO32U2P','p'=>5699.00,'i'=>'MON'],
            ['c'=>'monitor','n'=>'Alienware AW3225QF QD-OLED','p'=>5499.00,'i'=>'MON'],
            ['c'=>'monitor','n'=>'MSI MPG 321URX QD-OLED','p'=>5299.00,'i'=>'MON'],
            ['c'=>'monitor','n'=>'LG C3 42-inch OLED TV','p'=>4599.00,'i'=>'MON'],
            ['c'=>'monitor','n'=>'ASUS ProArt Display PA32','p'=>3899.00,'i'=>'MON'],
            // Keyboard (8)
            ['c'=>'keyboard','n'=>'ASUS ROG Azoth Extreme','p'=>1499.00,'i'=>'KEY'],
            ['c'=>'keyboard','n'=>'Corsair K100 AIR Wireless','p'=>1399.00,'i'=>'KEY'],
            ['c'=>'keyboard','n'=>'SteelSeries Apex Pro TKL','p'=>1250.00,'i'=>'KEY'],
            ['c'=>'keyboard','n'=>'Wooting 60HE+ Hall Effect','p'=>1199.00,'i'=>'KEY'],
            ['c'=>'keyboard','n'=>'Keychron Q1 HE Wireless','p'=>1099.00,'i'=>'KEY'],
            ['c'=>'keyboard','n'=>'Razer Huntsman V3 Pro','p'=>1050.00,'i'=>'KEY'],
            ['c'=>'keyboard','n'=>'Razer DeathStalker V2 Pro','p'=>999.00,'i'=>'KEY'],
            ['c'=>'keyboard','n'=>'NuPhy Field75 Wireless','p'=>799.00,'i'=>'KEY'],
            // Mouse (8)
            ['c'=>'mouse','n'=>'Razer Viper Mini Signature','p'=>1399.00,'i'=>'MICE'],
            ['c'=>'mouse','n'=>'Finalmouse UltralightX','p'=>1099.00,'i'=>'MICE'],
            ['c'=>'mouse','n'=>'Logitech G Pro X Superlight 2','p'=>799.00,'i'=>'MICE'],
            ['c'=>'mouse','n'=>'Razer Basilisk V3 Pro','p'=>750.00,'i'=>'MICE'],
            ['c'=>'mouse','n'=>'Zowie EC2-CW Wireless','p'=>750.00,'i'=>'MICE'],
            ['c'=>'mouse','n'=>'ASUS ROG Harpe Ace Aim Lab','p'=>699.00,'i'=>'MICE'],
            ['c'=>'mouse','n'=>'Logitech G502 X Plus','p'=>680.00,'i'=>'MICE'],
            ['c'=>'mouse','n'=>'Corsair M65 RGB ULTRA','p'=>599.00,'i'=>'MICE'],
            // Audio (8)
            ['c'=>'audio','n'=>'Sennheiser HD 800 S','p'=>8599.00,'i'=>'AMP'],
            ['c'=>'audio','n'=>'Astro A50 X Base Station','p'=>1899.00,'i'=>'AMP'],
            ['c'=>'audio','n'=>'SteelSeries Arctis Nova Pro','p'=>1799.00,'i'=>'AMP'],
            ['c'=>'audio','n'=>'Audeze Maxwell Planar','p'=>1599.00,'i'=>'AMP'],
            ['c'=>'audio','n'=>'Corsair Virtuoso RGB XT','p'=>1399.00,'i'=>'AMP'],
            ['c'=>'audio','n'=>'Logitech G PRO X 2','p'=>1299.00,'i'=>'AMP'],
            ['c'=>'audio','n'=>'EPOS H3PRO Hybrid','p'=>1199.00,'i'=>'AMP'],
            ['c'=>'audio','n'=>'Razer BlackShark V2 Pro','p'=>999.00,'i'=>'AMP'],
        ];

        $counter = 1;
        foreach ($products as $p) {
            Product::create([
                'category_id' => $catMap[$p['c']],
                'name' => $p['n'],
                'price' => $p['p'],
                'image_label' => $p['i'],
                'sku' => 'SKU-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
                'stock' => 50,
            ]);
            $counter++;
        }
    }
}
