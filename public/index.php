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

// Tambahan khusus untuk serverless Vercel agar bisa menulis cache dan views ke folder /tmp
$app->booted(function () {
    config(['view.compiled' => '/tmp/storage/framework/views']);
    config(['cache.stores.file.path' => '/tmp/storage/framework/cache/data']);
    config(['session.files' => '/tmp/storage/framework/sessions']);
});

$app->handleRequest(Request::capture());