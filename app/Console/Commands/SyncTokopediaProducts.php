<?php

namespace App\Console\Commands;

use App\Services\TokopediaService;
use Illuminate\Console\Command;

class SyncTokopediaProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokopedia:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi produk merchandise dari Tokopedia Open API ke database lokal';

    /**
     * Execute the console command.
     */
    public function handle(TokopediaService $tokopediaService): int
    {
        $this->info('Memulai proses sinkronisasi katalog merchandise Tokopedia...');

        $result = $tokopediaService->syncProducts();

        if ($result['success']) {
            $this->info($result['message']);
            return Command::SUCCESS;
        }

        $this->warn($result['message']);
        return Command::SUCCESS; // Return success so scheduler doesn't fail fatally
    }
}

