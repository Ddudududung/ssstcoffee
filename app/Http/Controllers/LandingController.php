<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hotspot;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    /**
     * Show the SSST Coffee Brand Landing Portal.
     */
    public function index()
    {
        $hotspots = Hotspot::orderBy('sort_order', 'asc')->get();

        $categories = Category::with(['menuItems' => function ($q) {
            $q->where('is_available', true)->orderBy('sort_order', 'asc');
        }])->orderBy('sort_order', 'asc')->get();

        $products = Product::where('is_active', true)->get();

        $outlets = Outlet::orderBy('sort_order', 'asc')->get();

        // Semua item menu (flat, urut kategori) untuk panel foto interaktif.
        // Foto dicari otomatis di public/images/menu/{slug}.{jpg,jpeg,png,webp}
        $allItems = $categories->flatMap(function ($cat) {
            return $cat->menuItems->map(function ($item) use ($cat) {
                $slug = \Str::slug($item->name);
                $img = null;
                foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
                    if (file_exists(public_path("images/menu/{$slug}.{$ext}"))) {
                        $img = asset("images/menu/{$slug}.{$ext}");
                        break;
                    }
                }
                return [
                    'cat' => $cat->slug,
                    'name' => $item->name,
                    'description' => $item->description,
                    'img' => $img,
                ];
            });
        })->values();

        // Doodle dekorasi latar: auto-detect public/images/doodle/*.{png,webp,jpg,jpeg}
        // Juga cek jika ada file doddle.png langsung di public/images/
        $doodleFiles = [];
        foreach (['png', 'webp', 'jpg', 'jpeg'] as $ext) {
            foreach (glob(public_path("images/doodle/*.{$ext}")) ?: [] as $f) {
                $doodleFiles[] = $f;
            }
        }
        if (empty($doodleFiles) && file_exists(public_path('images/doddle.png'))) {
            $doodleFiles[] = public_path('images/doddle.png');
        }
        $doodles = collect($doodleFiles)->sort()->values()->slice(0, 6)
            ->map(function ($p) {
                if (str_contains($p, 'doodle')) {
                    return asset('images/doodle/' . basename($p));
                }
                return asset('images/' . basename($p));
            })->all();

        // Foto galeri/event: auto-detect public/images/gallery/{1..8}.{jpg,jpeg,png,webp}
        $galleryPhotos = collect(range(1, 8))->map(function ($n) {
            $img = null;
            foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
                if (file_exists(public_path("images/gallery/{$n}.{$ext}"))) {
                    $img = asset("images/gallery/{$n}.{$ext}");
                    break;
                }
            }
            return ['n' => $n, 'img' => $img];
        })->values()->all();

        return view('landing', compact('hotspots', 'categories', 'products', 'outlets', 'allItems', 'galleryPhotos', 'doodles'));
    }
}

