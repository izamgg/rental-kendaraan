<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Tambahan khusus untuk serverless Vercel
$app->booted(function () {
    config(['view.compiled' => '/tmp/storage/framework/views']);
    config(['cache.stores.file.path' => '/tmp/storage/framework/cache/data']);
    config(['session.files' => '/tmp/storage/framework/sessions']);
    
    // Otomatis buat file database SQLite di /tmp jika belum ada
    if (config('database.default') === 'sqlite') {
        $dbPath = config('database.connections.sqlite.database');
        if (!file_exists($dbPath)) {
            @mkdir(dirname($dbPath), 0755, true);
            @touch($dbPath);
            
            // Otomatis jalankan migrasi tabel saat database pertama kali dibuat
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', [
                    '--force' => true,
                ]);
            } catch (\Exception $e) {
                // Dilewati agar aplikasi tidak crash jika ada kendala sistem
            }
        }
    }
});

$app->handleRequest(Request::capture());