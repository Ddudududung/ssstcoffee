<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Brand Portal for SSST Coffee.
| Serves landing page, interactive hotspots, menu catalog, merch, and outlets.
|
*/

Route::get('/', [LandingController::class, 'index'])->name('home');
