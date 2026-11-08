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

        // 2. Categories & Menu Items — menu resmi (harga tersimpan di DB, web tidak menampilkannya)
        $catCoffee  = Category::updateOrCreate(['slug' => 'coffee'],        ['name' => 'SSST Coffee',    'sort_order' => 1]);
        $catClassic = Category::updateOrCreate(['slug' => 'classic-coffee'],['name' => 'Classic Coffee', 'sort_order' => 2]);
        $catOthers  = Category::updateOrCreate(['slug' => 'others'],        ['name' => 'Others',         'sort_order' => 3]);
        $catMock    = Category::updateOrCreate(['slug' => 'mocktails'],     ['name' => 'Mocktails',      'sort_order' => 4]);

        // Hapus kategori di luar menu resmi (Add On, KOPI/SNACK/dll lama) beserta item-nya (cascade)
        Category::whereNotIn('slug', ['coffee', 'classic-coffee', 'others', 'mocktails'])->delete();

        $menuItems = [
            // SSST Coffee — kolom: Ice | Hot | 500ml | 1L
            ['category_id' => $catCoffee->id,  'name' => 'Ssst Kopi Susu',     'description' => 'Kopi susu signature SSST.',                    'price_ice' => 20, 'price_hot' => 18,   'price_half_liter' => 50,  'price_one_liter' => 100, 'sort_order' => 1],
            ['category_id' => $catCoffee->id,  'name' => 'Ssst Kopi BOL:D',    'description' => 'Kopi susu berkarakter pekat.',                 'price_ice' => 23, 'price_hot' => null, 'price_half_liter' => 60,  'price_one_liter' => 115, 'sort_order' => 2],
            ['category_id' => $catCoffee->id,  'name' => 'Ssst Kopi Almond',   'description' => 'Gurih almond bertemu espresso.',               'price_ice' => 25, 'price_hot' => null, 'price_half_liter' => 65,  'price_one_liter' => 125, 'sort_order' => 3],
            ['category_id' => $catCoffee->id,  'name' => 'Ssst Butterscotch',  'description' => 'Manis karamel mentega yang creamy.',           'price_ice' => 25, 'price_hot' => null, 'price_half_liter' => 65,  'price_one_liter' => 125, 'sort_order' => 4],
            ['category_id' => $catCoffee->id,  'name' => 'Ssst Caramel',       'description' => 'Klasik karamel susu espresso.',                'price_ice' => 23, 'price_hot' => null, 'price_half_liter' => 65,  'price_one_liter' => 125, 'sort_order' => 5],
            ['category_id' => $catCoffee->id,  'name' => 'Ssst Kopi Hitam',    'description' => 'Kopi hitam bersih, dingin atau hangat.',       'price_ice' => 20, 'price_hot' => 18,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 6],

            // Classic Coffee — kolom: Ice | Hot
            ['category_id' => $catClassic->id, 'name' => 'Short Black',        'description' => 'Single shot espresso murni.',                  'price_ice' => null,'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 1],
            ['category_id' => $catClassic->id, 'name' => 'Long Black',         'description' => 'Espresso di atas air panas.',                  'price_ice' => 25,  'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 2],
            ['category_id' => $catClassic->id, 'name' => 'Filter / V60',       'description' => 'Seduhan manual, karakter biji yang jujur.',    'price_ice' => 25,  'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 3],
            ['category_id' => $catClassic->id, 'name' => 'Piccolo',            'description' => 'Espresso dengan susu sedikit, ringan.',        'price_ice' => null,'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 4],
            ['category_id' => $catClassic->id, 'name' => 'Cappuccino',         'description' => 'Espresso, susu, dan busa tebal.',              'price_ice' => 30,  'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 5],
            ['category_id' => $catClassic->id, 'name' => 'Latte',              'description' => 'Espresso berpadu steamed milk.',               'price_ice' => 25,  'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 6],
            ['category_id' => $catClassic->id, 'name' => 'Magic',              'description' => 'Double ristretto dan susu — favorit lokal.',   'price_ice' => 25,  'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 7],

            // Others — kolom: Ice | Hot
            ['category_id' => $catOthers->id,  'name' => 'Chocolate Cream Java','description' => 'Cokelat creamy dengan saji kaya.',            'price_ice' => 25,  'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 1],
            ['category_id' => $catOthers->id,  'name' => 'Matcha Latte',        'description' => 'Matcha murni dengan susu lembut.',             'price_ice' => 25,  'price_hot' => 25,   'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 2],
            ['category_id' => $catOthers->id,  'name' => 'Earlgrey Candy Milk Tea','description' => 'Teh earl grey manis berbalut susu.',       'price_ice' => 20,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 3],
            ['category_id' => $catOthers->id,  'name' => 'Earlgrey Tea',        'description' => 'Teh hitam bergamot murni.',                    'price_ice' => 20,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 4],
            ['category_id' => $catOthers->id,  'name' => 'Sweet Maya',          'description' => 'Manis dingin yang mudah disukai.',             'price_ice' => 25,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 5],

            // Mocktails — kolom: Ice
            ['category_id' => $catMock->id,    'name' => 'Essst A-mer',         'description' => 'Mocktail signature dingin SSST.',              'price_ice' => 25,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 1],
            ['category_id' => $catMock->id,    'name' => 'Roots',               'description' => 'Segar dengan sentuhan earthy.',                'price_ice' => 25,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 2],
            ['category_id' => $catMock->id,    'name' => 'Pine Oasis',          'description' => 'Nanas menyegarkan di tengah hari.',            'price_ice' => 25,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 3],
            ['category_id' => $catMock->id,    'name' => 'Black Canary',        'description' => 'Gelap, dingin, dan berani.',                   'price_ice' => 25,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 4],
            ['category_id' => $catMock->id,    'name' => 'Sweet Caroline',      'description' => 'Manis klasik untuk penutup hari.',             'price_ice' => 25,  'price_hot' => null, 'price_half_liter' => null,'price_one_liter' => null,'sort_order' => 5],
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
            [
                'name' => 'Pajajaran',
                'address' => 'Jl. Pajajaran No.37A, Pasir Kaliki, Kec. Cicendo, Kota Bandung, Jawa Barat 40171',
                'city' => 'Bandung',
                'opening_hours' => '07.00 - 21.00',
                'phone' => '(62) 8715 6178 190',
                'maps_url' => 'https://maps.google.com/?q=Jl.+Pajajaran+No.37A+Pasir+Kaliki+Cicendo+Bandung',
                'sort_order' => 4,
            ],
        ];

        foreach ($outlets as $outlet) {
            Outlet::updateOrCreate(['name' => $outlet['name']], $outlet);
        }
    }
}

