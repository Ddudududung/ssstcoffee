<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('price_ice')->nullable(); // dalam ribuan (20 = 20k)
            $table->unsignedInteger('price_hot')->nullable();
            $table->unsignedInteger('price_half_liter')->nullable();
            $table->unsignedInteger('price_one_liter')->nullable();
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('tokopedia_id')->nullable()->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price'); // harga rupiah penuh, misal 89000
            $table->string('image_url')->nullable();
            $table->string('tokopedia_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });

        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('city')->default('Bandung');
            $table->string('opening_hours')->default('07.00 - 21.00');
            $table->string('phone')->nullable();
            $table->string('maps_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('hotspots', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // "Outlet", "Menu kopi", dll
            $table->string('title'); // "Menu kopi"
            $table->text('description'); // "Dari Ssst Kopi Susu sampai Magic. Menunya ringkas..."
            $table->string('target_section'); // "#menu", "#outlet", "#cerita", "#merch"
            $table->string('action_text')->default('Lihat menu →');
            $table->decimal('x_percent', 5, 2); // 0-100%
            $table->decimal('y_percent', 5, 2); // 0-100%
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotspots');
        Schema::dropIfExists('outlets');
        Schema::dropIfExists('products');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('categories');
    }
};

