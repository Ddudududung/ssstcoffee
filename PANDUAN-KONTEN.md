# PANDUAN KONTEN — SSST Coffee Website

Panduan buat owner/tim buat ganti link & nambah gambar **tanpa ngerti kode**.
Semua file yang perlu diubah ada di **satu file**: `resources/views/landing.blade.php`.
Cari (Ctrl+F) kata kunci `TODO` — semua titik yang perlu diisi udah ditandai.

---

## 1. GAMBAR — cukup taruh file, tanpa edit kode

Semua foto cukup **copy-paste ke folder** `public/images/...` dengan **nama sesuai aturan**.
Website otomatis mendeteksi file-nya (cek ekstensi jpg, jpeg, png, webp).

### Foto menu (panel foto kiri, muncul saat item diklik)
```
Folder : public/images/menu/
Nama   : nama item, huruf kecil, spasi jadi tanda minus
```
| Item di menu | Nama file |
|---|---|
| Ssst Kopi Susu | `ssst-kopi-susu.jpg` |
| Ssst Kopi BOL:D | `ssst-kopi-bold.jpg` |
| Ssst Kopi Almond | `ssst-kopi-almond.jpg` |

> Aturan nama: huruf kecil semua, spasi → `-`, buang karakter aneh (`:` `&` `.` dll).
> Contoh: "Es Kopi Susu Gula Aren" → `es-kopi-susu-gula-aren.jpg`

### Foto merch
```
Folder : public/images/merch/
Nama   : nama produk di database, aturan sama
```
Contoh: `totebag.jpg`, `tumbler-stainless.jpg`

### Foto galeri
```
Folder : public/images/gallery/
```
Lalu buka `landing.blade.php`, cari `TODO: Ganti setiap div.gallery-item`,
ganti placeholder dengan blok `<img>` yang contohnya sudah ditulis di situ.

### Foto ambience outlet
```
Folder : public/images/outlets/
Nama   : nama outlet → cibeunying.jpg, buah-batu.jpg, margahayu.jpg, pajajaran.jpg
```
Cari `TODO: Ganti div placeholder ini dengan:` di section Lokasi, ikuti contohnya.

### Logo
Sudah dipakai dari `public/images/logo.png`. Tinggal **timpa file** itu kalau mau ganti
(rasio persegi/transparan, putih atau hitam — sesuai brand book).

---

## 2. LINK — edit di `landing.blade.php`

### Link GoFood / GrabFood / ShopeeFood (atas section Menu)
Cari: `TODO: ganti # dengan URL` → ganti `href="#"` dengan URL asli, contoh:
```html
<a href="https://food.grab.com/id/id/restaurant/ssst-coffee-cibeunying/..." ...>
```

### Link per outlet (di kartu Lokasi)
Cari: `TODO: ganti # dengan URL GrabFood/GoFood/ShopeeFood outlet` —
ada 3 link di tiap kartu outlet, isi sesuai toko tersebut.

### Link Tokopedia per produk merch
Cari: `TODO: ganti href dengan URL Tokopedia` — atau lebih gampang:
isi kolom `tokopedia_url` di tabel `products` (lewat panel admin / database),
website otomatis memakainya.

### Google Maps outlet
Isi kolom `maps_url` di tabel `outlets` (format bebas, link share Google Maps).

---

## 3. DATA (menu, outlet, hotspot, produk)

Pakai tinker dari folder project (Laragon Terminal):
```bash
php artisan tinker
```
Contoh nambah menu baru:
```php
App\Models\MenuItem::create(['category_id' => 1, 'name' => 'Ssst Kopi Hazelnut', 'description' => 'Paduan susu hazelnut dengan espresso.', 'price_ice' => 22, 'sort_order' => 10]);
```
Contoh nambah outlet baru:
```php
App\Models\Outlet::create(['name' => 'Dago', 'address' => 'Jl. Ir. H. Juanda No. 100, Bandung', 'sort_order' => 5]);
```
Setelah itu **hard refresh** browser (Ctrl+F5).

---

## 4. CETAK WARNA & FONT (referensi cepat)

- Hitam `#1d1d1f` · Abu gelap `#48484A` · Abu sedang `#737375` · Abu terang `#9F9FA1` · Abu muda `#CACACC` · Putih `#f5f5f7`
- Judul = Creato Display (ExtraBold/Bold) · Isi = Creato Display (Regular/Medium) · Aksen tulisan tangan = Kopi Susu · Logo/kata kunci = Baligo

---

## 5. COMANDS HARIAN (Laragon Terminal)

```bash
cd C:\laragon\www\ssstcoffee
php artisan serve            # jalankan di http://127.0.0.1:8000
php artisan migrate          # update struktur database
php artisan db:seed --class=SSSTDatabaseSeeder   # isi ulang data awal
```
