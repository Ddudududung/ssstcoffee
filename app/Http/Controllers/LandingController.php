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

        // Botol & Kaleng ready to go variants (as specified in PRD & mockups)
        $bottlesAndCans = [
            [
                'name' => 'ESSST KOPI SUSU',
                'size' => '1 L',
                'bg' => 'bg-white text-ssst-black',
                'badge_bg' => 'bg-ssst-black text-white',
                'sub' => 'Varian Botol Kulkas',
                'price' => '100',
            ],
            [
                'name' => 'ESSST KOPI SUSU',
                'size' => '500 ML',
                'bg' => 'bg-[#2b2b2e] text-white border border-[#3e3e42]',
                'badge_bg' => 'bg-white text-ssst-black',
                'sub' => 'Varian Botol Personal',
                'price' => '50',
            ],
            [
                'name' => 'ESSST AMER',
                'size' => '250 ML',
                'bg' => 'bg-[#48484a] text-white',
                'badge_bg' => 'bg-ssst-black text-white',
                'sub' => 'Americano Kaleng Dingin',
                'price' => '25',
            ],
        ];

        return view('landing', compact('hotspots', 'categories', 'products', 'outlets', 'bottlesAndCans'));
    }
}

