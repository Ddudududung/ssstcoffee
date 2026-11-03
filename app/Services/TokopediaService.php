<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TokopediaService
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $fsId;
    protected string $shopId;
    protected string $apiUrl;
    protected string $authUrl;

    public function __construct()
    {
        $this->clientId = config('tokopedia.client_id', '');
        $this->clientSecret = config('tokopedia.client_secret', '');
        $this->fsId = config('tokopedia.fs_id', '');
        $this->shopId = config('tokopedia.shop_id', '');
        $this->apiUrl = config('tokopedia.api_url', 'https://fs.tokopedia.net');
        $this->authUrl = config('tokopedia.auth_url', 'https://accounts.tokopedia.com/token?grant_type=client_credentials');
    }

    /**
     * Check if Tokopedia credentials are provided.
     */
    public function isConfigured(): bool
    {
        return !empty($this->clientId) && !empty($this->clientSecret) && !empty($this->fsId);
    }

    /**
     * Retrieve OAuth2 Bearer token with caching.
     */
    public function getAccessToken(): ?string
    {
        if (!$this->isConfigured()) {
            return null;
        }

        return Cache::remember('tokopedia_access_token', 3600, function () {
            try {
                $response = Http::asForm()
                    ->withBasicAuth($this->clientId, $this->clientSecret)
                    ->post($this->authUrl);

                if ($response->successful()) {
                    $data = $response->json();
                    return $data['access_token'] ?? null;
                }

                Log::error('Tokopedia Auth failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            } catch (\Exception $e) {
                Log::error('Tokopedia Auth exception: ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Fetch products from Tokopedia API.
     */
    public function fetchRemoteProducts(int $page = 1, int $perPage = 20): array
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return [];
        }

        try {
            $endpoint = "{$this->apiUrl}/inventory/v1/fs/{$this->fsId}/product/info";
            $response = Http::withToken($token)->get($endpoint, [
                'shop_id' => $this->shopId,
                'page' => $page,
                'per_page' => $perPage,
            ]);

            if ($response->successful()) {
                return $response->json('data') ?? [];
            }

            Log::warning('Tokopedia Product API response error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            return [];
        } catch (\Exception $e) {
            Log::error('Tokopedia Fetch exception: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Synchronize products to local database.
     * Retains local catalog if API is offline / unconfigured.
     */
    public function syncProducts(): array
    {
        if (!$this->isConfigured()) {
            return [
                'success' => false,
                'message' => 'Kredensial Tokopedia API belum dikonfigurasi di .env. Menggunakan data katalog lokal.',
                'synced_count' => 0,
            ];
        }

        $remoteProducts = $this->fetchRemoteProducts();
        if (empty($remoteProducts)) {
            return [
                'success' => false,
                'message' => 'Tidak dapat mengambil data dari Tokopedia API. Data lokal tetap dipertahankan.',
                'synced_count' => 0,
            ];
        }

        $count = 0;
        foreach ($remoteProducts as $item) {
            $name = $item['basic']['name'] ?? 'Merch SSST';
            $price = $item['price']['value'] ?? 0;
            $tokopediaId = (string)($item['basic']['product_id'] ?? '');
            $description = $item['extra']['short_description'] ?? $item['basic']['snippet'] ?? '';
            $imageUrl = $item['pictures'][0]['url_original'] ?? null;
            $url = $item['other']['url'] ?? null;

            Product::updateOrCreate(
                ['tokopedia_id' => $tokopediaId],
                [
                    'name' => $name,
                    'slug' => Str::slug($name) . '-' . substr(md5($tokopediaId), 0, 4),
                    'description' => $description,
                    'price' => $price,
                    'image_url' => $imageUrl,
                    'tokopedia_url' => $url,
                    'is_active' => true,
                    'last_synced_at' => now(),
                ]
            );
            $count++;
        }

        return [
            'success' => true,
            'message' => "Berhasil menyinkronkan {$count} produk merch dari Tokopedia.",
            'synced_count' => $count,
        ];
    }
}

