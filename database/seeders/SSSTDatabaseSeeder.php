<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Product;
use App\Models\Outlet;
use App\Models\Hotspot;
use Illuminate\Database\Seeder;

class SSSTDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hotspots
        $hotspots = [
            [
                'label' => 'Outlet',
                'title' => 'Kedai SSST Coffee',
                'description' => 'Titik singgah utama dengan suasana hangat. Buka setiap hari dari 07.00 sampai 21.00 di Bandung.',
                'target_section' => '#outlet',
                'action_text' => 'Lihat outlet →',
                'x_percent' => 17.5,
                'y_percent' => 52.0,
                'sort_order' => 1,
            ],
            [
                'label' => 'Merch',
                'title' => 'Bawa Pulang Merch',
                'description' => 'Totebag, tumbler stainless, sticker pack, dan printables resmi SSST via Tokopedia.',
                'target_section' => '#merch',
                'action_text' => 'Lihat merch →',
                'x_percent' => 31.0,
                'y_percent' => 59.0,
                'sort_order' => 2,
            ],
            [
                'label' => 'Menu kopi',
                'title' => 'Menu kopi',
                'description' => 'Dari Ssst Kopi Susu sampai Magic. Menunya ringkas, jadi milihnya cepat.',
                'target_section' => '#menu',
                'action_text' => 'Lihat menu →',
                'x_percent' => 41.5,
                'y_percent' => 36.0,
                'sort_order' => 3,
            ],
            [
                'label' => 'Post run pitstop',
                'title' => 'Post Run Pitstop',
                'description' => 'Tempat singgah pelari dan pejalan pagi buat rehidrasi dan segelas kopi dingin sehabis workout.',
                'target_section' => '#cerita',
                'action_text' => 'Baca cerita →',
                'x_percent' => 53.5,
                'y_percent' => 36.5,
                'sort_order' => 4,
            ],
            [
                'label' => 'Lanjut ngobrol',
                'title' => 'Lanjut Ngobrol',
                'description' => 'Abis makan siang atau malam, mampir lanjut ngobrol santai tanpa mikir lama.',
                'target_section' => '#menu',
                'action_text' => 'Pilih kopi →',
                'x_percent' => 73.5,
                'y_percent' => 44.0,
                'sort_order' => 5,
            ],
            [
                'label' => 'Quick stop',
                'title' => 'Quick Coffee Stop',
                'description' => 'Pesepeda & komuter: ambil take-away cepat dalam ritme mobilitas harianmu.',
                'target_section' => '#outlet',
                'action_text' => 'Cek lokasi →',
                'x_percent' => 86.5,
                'y_percent' => 41.0,
                'sort_order' => 6,
            ],
        ];

        foreach ($hotspots as $hotspot) {
            Hotspot::updateOrCreate(['label' => $hotspot['label']], $hotspot);
        }

        // 2. Categories & Menu Items
        $catCoffee = Category::updateOrCreate(['slug' => 'coffee'], ['name' => 'Coffee', 'sort_order' => 1]);
        $catClassic = Category::updateOrCreate(['slug' => 'classic-coffee'], ['name' => 'Classic Coffee', 'sort_order' => 2]);
        $catOthers = Category::updateOrCreate(['slug' => 'others'], ['name' => 'Others', 'sort_order' => 3]);
        $catAddon = Category::updateOrCreate(['slug' => 'add-on'], ['name' => 'Add On', 'sort_order' => 4]);

        $menuItems = [
            // Coffee
            [
                'category_id' => $catCoffee->id,
                'name' => 'Ssst Kopi Susu',
                'description' => 'Kopi susu khas SSST dengan racikan espresso giling segar dan krimer lembut.',
                'price_ice' => 20,
                'price_hot' => 18,
                'price_half_liter' => 50,
                'price_one_liter' => 100,
                'sort_order' => 1,
            ],
            [
                'category_id' => $catCoffee->id,
                'name' => 'Ssst Kopi BOL:D',
                'description' => 'Rasa kopi lebih pekat dan intens, cocok untuk mood produktif harian.',
                'price_ice' => 23,
                'price_hot' => null,
                'price_half_liter' => 60,
                'price_one_liter' => 115,
                'sort_order' => 2,
            ],
            [
                'category_id' => $catCoffee->id,
                'name' => 'Ssst Kopi Almond',
                'description' => 'Paduan susu almond gurih dengan house blend espresso SSST.',
                'price_ice' => 25,
                'price_hot' => null,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 3,
            ],
            [
                'category_id' => $catCoffee->id,
                'name' => 'Ssst Kopi Hitam',
                'description' => 'Kopi hitam dingin atau hangat dengan aroma roasted beans yang bersih.',
                'price_ice' => 20,
                'price_hot' => 18,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 4,
            ],
            [
                'category_id' => $catCoffee->id,
                'name' => 'Ssst Kopi Cinnamon',
                'description' => 'Sentuhan rempah kayu manis aromatik yang menghangatkan selera.',
                'price_ice' => 22,
                'price_hot' => 20,
                'price_half_liter' => 55,
                'price_one_liter' => 105,
                'sort_order' => 5,
            ],

            // Classic Coffee
            [
                'category_id' => $catClassic->id,
                'name' => 'Americano',
                'description' => 'Double espresso shot yang dilarutkan air mineral murni.',
                'price_ice' => 20,
                'price_hot' => 18,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 1,
            ],
            [
                'category_id' => $catClassic->id,
                'name' => 'Cafe Latte',
                'description' => 'Espresso berpadu steamed fresh milk dengan microfoam halus.',
                'price_ice' => 24,
                'price_hot' => 22,
                'price_half_liter' => 55,
                'price_one_liter' => 110,
                'sort_order' => 2,
            ],
            [
                'category_id' => $catClassic->id,
                'name' => 'Cappuccino',
                'description' => 'Rasio seimbang antara espresso kuat, milk, dan busa tebal.',
                'price_ice' => 24,
                'price_hot' => 22,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 3,
            ],
            [
                'category_id' => $catClassic->id,
                'name' => 'Flat White',
                'description' => 'Tekstur velvety milk lembut dengan rasa kopi yang dominan.',
                'price_ice' => null,
                'price_hot' => 22,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 4,
            ],
            [
                'category_id' => $catClassic->id,
                'name' => 'Mocha',
                'description' => 'Kombinasi rich chocolate dan espresso susu yang decadent.',
                'price_ice' => 26,
                'price_hot' => 24,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 5,
            ],

            // Others
            [
                'category_id' => $catOthers->id,
                'name' => 'Signature Matcha Latte',
                'description' => 'Matcha murni berkualitas tinggi dengan susu segar creamy.',
                'price_ice' => 24,
                'price_hot' => 22,
                'price_half_liter' => 60,
                'price_one_liter' => 115,
                'sort_order' => 1,
            ],
            [
                'category_id' => $catOthers->id,
                'name' => 'Dark Chocolate',
                'description' => 'Cokelat hitam pekat kaya antioksidan dengan sweetness pas.',
                'price_ice' => 24,
                'price_hot' => 22,
                'price_half_liter' => 60,
                'price_one_liter' => 115,
                'sort_order' => 2,
            ],
            [
                'category_id' => $catOthers->id,
                'name' => 'Earl Grey Milk Tea',
                'description' => 'Teh hitam bergamot yang harum dalam balutan susu dingin.',
                'price_ice' => 22,
                'price_hot' => 20,
                'price_half_liter' => 50,
                'price_one_liter' => 100,
                'sort_order' => 3,
            ],
            [
                'category_id' => $catOthers->id,
                'name' => 'Sparkling Lemon Honey',
                'description' => 'Soda segar dingin dengan madu murni dan perasan lemon asli.',
                'price_ice' => 22,
                'price_hot' => null,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 4,
            ],
            [
                'category_id' => $catOthers->id,
                'name' => 'Mineral Water',
                'description' => 'Air mineral kemasan dingin 330ml.',
                'price_ice' => 10,
                'price_hot' => null,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 5,
            ],

            // Add On
            [
                'category_id' => $catAddon->id,
                'name' => 'Extra Espresso Shot',
                'description' => 'Tambahan 1 shot espresso untuk dorongan energi ekstra.',
                'price_ice' => 6,
                'price_hot' => 6,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 1,
            ],
            [
                'category_id' => $catAddon->id,
                'name' => 'Oat Milk Swap',
                'description' => 'Ganti susu sapi dengan oat milk plant-based.',
                'price_ice' => 8,
                'price_hot' => 8,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 2,
            ],
            [
                'category_id' => $catAddon->id,
                'name' => 'Vanilla / Caramel Syrup',
                'description' => 'Tambahan sirup perasa manis harum.',
                'price_ice' => 5,
                'price_hot' => 5,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 3,
            ],
            [
                'category_id' => $catAddon->id,
                'name' => 'Coffee Jelly Topping',
                'description' => 'Jeli kopi kenyal legit untuk sensasi kunyah segar.',
                'price_ice' => 5,
                'price_hot' => null,
                'price_half_liter' => null,
                'price_one_liter' => null,
                'sort_order' => 4,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::updateOrCreate(
                ['category_id' => $item['category_id'], 'name' => $item['name']],
                $item
            );
        }

        // 3. Products (Tokopedia Merch)
        $products = [
            [
                'tokopedia_id' => 'TOKOPEDIA-SSST-001',
                'name' => 'Tumbler SSST',
                'slug' => 'tumbler-ssst',
                'description' => 'Stainless steel double wall vacuum insulated, sablon ilustrasi SSST, tahan dingin 18 jam.',
                'price' => 149000,
                'image_url' => '/images/merch/tumbler.svg',
                'tokopedia_url' => 'https://www.tokopedia.com',
                'is_active' => true,
                'last_synced_at' => now(),
            ],
            [
                'tokopedia_id' => 'TOKOPEDIA-SSST-002',
                'name' => 'Totebag SSST',
                'slug' => 'totebag-ssst',
                'description' => 'Kanvas tebal 14oz, sablon 21 x 23 cm, kuat muat laptop dan kebutuhan ngopi harian.',
                'price' => 89000,
                'image_url' => '/images/merch/totebag.svg',
                'tokopedia_url' => 'https://www.tokopedia.com',
                'is_active' => true,
                'last_synced_at' => now(),
            ],
            [
                'tokopedia_id' => 'TOKOPEDIA-SSST-003',
                'name' => 'Sticker Pack SSST',
                'slug' => 'sticker-pack-ssst',
                'description' => '10 stiker ilustrasi doodle vinyl tahan air, ukuran lembar A5, cutting presisi.',
                'price' => 29000,
                'image_url' => '/images/merch/sticker.svg',
                'tokopedia_url' => 'https://www.tokopedia.com',
                'is_active' => true,
                'last_synced_at' => now(),
            ],
            [
                'tokopedia_id' => 'TOKOPEDIA-SSST-004',
                'name' => 'Pin Enamel SSST',
                'slug' => 'pin-enamel-ssst',
                'description' => 'Enamel lapis silver mengkilap, ukuran 6 x 2.4 cm, pin pengait ganda kokoh.',
                'price' => 39000,
                'image_url' => '/images/merch/pin.svg',
                'tokopedia_url' => 'https://www.tokopedia.com',
                'is_active' => true,
                'last_synced_at' => now(),
            ],
            [
                'tokopedia_id' => 'TOKOPEDIA-SSST-005',
                'name' => 'Apron Barista SSST',
                'slug' => 'apron-barista-ssst',
                'description' => 'Kanvas hitam drill tahan percikan kopi, sablon ilustrasi, strap kulit sintetis.',
                'price' => 129000,
                'image_url' => '/images/merch/apron.svg',
                'tokopedia_url' => 'https://www.tokopedia.com',
                'is_active' => true,
                'last_synced_at' => now(),
            ],
            [
                'tokopedia_id' => 'TOKOPEDIA-SSST-006',
                'name' => 'Korek Gas SSST',
                'slug' => 'korek-gas-ssst',
                'description' => 'Korek gas isi ulang, sablon 1.5 x 8 cm dengan logo doodle SSST.',
                'price' => 15000,
                'image_url' => '/images/merch/lighter.svg',
                'tokopedia_url' => 'https://www.tokopedia.com',
                'is_active' => true,
                'last_synced_at' => now(),
            ],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(['slug' => $prod['slug']], $prod);
        }

        // 4. Outlets
        $outlets = [
            [
                'name' => 'Cibeunying',
                'address' => 'Jl. Cibeunying Selatan No. 12, Cihapit, Kec. Bandung Wetan, Kota Bandung',
                'city' => 'Bandung',
                'opening_hours' => '07.00 - 21.00',
                'phone' => '(62) 8715 6178 190',
                'maps_url' => 'https://maps.google.com/?q=Bandung+Cibeunying',
                'sort_order' => 1,
            ],
            [
                'name' => 'Buah Batu',
                'address' => 'Jl. Buah Batu No. 154, Turangga, Kec. Lengkong, Kota Bandung',
                'city' => 'Bandung',
                'opening_hours' => '07.00 - 21.00',
                'phone' => '(62) 8715 6178 190',
                'maps_url' => 'https://maps.google.com/?q=Bandung+Buah+Batu',
                'sort_order' => 2,
            ],
            [
                'name' => 'Margahayu',
                'address' => 'Jl. Margahayu Raya Barat No. 88, Kec. Buahbatu, Kota Bandung',
                'city' => 'Bandung',
                'opening_hours' => '07.00 - 21.00',
                'phone' => '(62) 8715 6178 190',
                'maps_url' => 'https://maps.google.com/?q=Bandung+Margahayu',
                'sort_order' => 3,
            ],
        ];

        foreach ($outlets as $outlet) {
            Outlet::updateOrCreate(['name' => $outlet['name']], $outlet);
        }
    }
}

